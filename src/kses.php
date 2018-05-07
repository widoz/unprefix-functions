<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

/*
 * This file is part of the Unprefix Functions package.
 *
 * (c) Guido Scialfa
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Unprefix\Functions\Kses;

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
            'src' => true,
            'srcset' => true,
            'sizes' => true,
            'class' => true,
            'id' => true,
            'width' => true,
            'height' => true,
            'alt' => true,
            'longdesc' => true,
            'usemap' => true,
            'align' => true,
            'border' => true,
            'hspace' => true,
            'vspace' => true,
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
        'input' => [
            'accept' => true,
            'autocomplete' => true,
            'autofocus' => true,
            'checked' => true,
            'class' => true,
            'disabled' => true,
            'id' => true,
            'height' => true,
            'min' => true,
            'max' => true,
            'minlenght' => true,
            'maxlength' => true,
            'name' => true,
            'pattern' => true,
            'placeholder' => true,
            'readony' => true,
            'required' => true,
            'size' => true,
            'src' => true,
            'step' => true,
            'type' => true,
            'value' => true,
            'width' => true,
        ],
        'select' => [
            'autofocus' => true,
            'class' => true,
            'id' => true,
            'disabled' => true,
            'form' => true,
            'multiple' => true,
            'name' => true,
            'required' => true,
            'size' => true,
        ],
        'option' => [
            'disabled' => true,
            'label' => true,
            'selected' => true,
            'value' => true,
        ],
        'optgroup' => [
            'disabled' => true,
            'label' => true,
        ],
        'textarea' => [
            'placeholder' => true,
            'cols' => true,
            'rows' => true,
            'disabled' => true,
            'name' => true,
            'id' => true,
            'readonly' => true,
            'required' => true,
            'autofocus' => true,
            'form' => true,
            'wrap' => true,
        ],
        'picture' => true,
        'source' => [
            'sizes' => true,
            'src' => true,
            'srcset' => true,
            'type' => true,
            'media' => true,
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
        'id' => true,
        'class' => true,
        'form' => true,
        'name' => true,
    ]);

    return wp_kses($data, $tagsInputIncluded);
}
