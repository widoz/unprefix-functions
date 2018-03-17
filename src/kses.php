<?php
declare(strict_types=1);

/**
 * Kses Functions
 *
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 * @package Unprefix\Functions
 * @license GNU General Public License, version 2
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

namespace Unprefix\Functions;

/**
 * Kses Image
 *
 * This is a wrapper function for wp_kses that allow only specific  html attributes for images.
 *
 * @uses wp_kses()
 *
 * @param string $img The image string to process.
 *
 * @return string The processed string containing only the allowed attributes
 */
function ksesImage(string $img): string
{
    /**
     * Filter Kses Image
     *
     * @param array $list The list of the allowed attributes
     */
    $attrs = apply_filters('unprefix_kses_image_allowed_attrs', [
        'img' => [
            'src'      => true,
            'srcset'   => true,
            'sizes'    => true,
            'class'    => true,
            'id'       => true,
            'width'    => true,
            'height'   => true,
            'alt'      => true,
            'longdesc' => true,
            'usemap'   => true,
            'align'    => true,
            'border'   => true,
            'hspace'   => true,
            'vspace'   => true,
        ],
    ]);

    return wp_kses($img, $attrs);
}

/**
 * Sanitize content for allowed HTML tags for post content.
 *
 * Post content refers to the page contents of the 'post' type and not $_POST
 * data from forms.
 *
 * @todo  Remove if the issue will be fixed. See below.
 * @see   https://core.trac.wordpress.org/ticket/37085
 *
 * @param string $data       Post content to filter.
 * @param array  $extraAttrs Extra attributes to allow.
 *
 * @return string Filtered post content with allowed HTML tags and attributes intact.
 */
function ksesPost(string $data, array $extraAttrs = []): string
{
    global $allowedposttags;

    $tagsInputIncluded = array_merge($allowedposttags, [
        'input'    => [
            'accept'       => true,
            'autocomplete' => true,
            'autofocus'    => true,
            'checked'      => true,
            'class'        => true,
            'disabled'     => true,
            'id'           => true,
            'height'       => true,
            'min'          => true,
            'max'          => true,
            'minlenght'    => true,
            'maxlength'    => true,
            'name'         => true,
            'pattern'      => true,
            'placeholder'  => true,
            'readony'      => true,
            'required'     => true,
            'size'         => true,
            'src'          => true,
            'step'         => true,
            'type'         => true,
            'value'        => true,
            'width'        => true,
        ],
        'select'   => [
            'autofocus' => true,
            'class'     => true,
            'id'        => true,
            'disabled'  => true,
            'form'      => true,
            'multiple'  => true,
            'name'      => true,
            'required'  => true,
            'size'      => true,
        ],
        'option'   => [
            'disabled' => true,
            'label'    => true,
            'selected' => true,
            'value'    => true,
        ],
        'optgroup' => [
            'disabled' => true,
            'label'    => true,
        ],
        'textarea' => [
            'placeholder' => true,
            'cols'        => true,
            'rows'        => true,
            'disabled'    => true,
            'name'        => true,
            'id'          => true,
            'readonly'    => true,
            'required'    => true,
            'autofocus'   => true,
            'form'        => true,
            'wrap'        => true,
        ],
        'picture'  => true,
        'source'   => [
            'sizes'  => true,
            'src'    => true,
            'srcset' => true,
            'type'   => true,
            'media'  => true,
        ],
    ]);

    if ($extraAttrs) {
        // Extract the key for comparison.
        $extraAttrsKeys = array_keys($extraAttrs);
        foreach ($tagsInputIncluded as $tag => $attrs) {
            // It is a tag where we want to insert additional attributes?
            if (in_array($tag, $extraAttrsKeys, true)) {
                // If so, include the extra attributes list within the main tags input list.
                $tagsInputIncluded[$tag] = array_merge($tagsInputIncluded[$tag], $extraAttrs[$tag]);
            }
        }
    }

    // Form attributes.
    $tagsInputIncluded['form'] = array_merge($tagsInputIncluded['form'], ['novalidate' => true]);
    // Fieldset attributes.
    // WordPress have an empty array.
    $tagsInputIncluded['fieldset'] = array_merge($tagsInputIncluded['fieldset'], [
        'id'    => true,
        'class' => true,
        'form'  => true,
        'name'  => true,
    ]);

    return wp_kses($data, $tagsInputIncluded);
}
