<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

/*
 * This file is part of the WordPress Functions package.
 *
 * (c) Guido Scialfa
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WordPress\Functions\Kses;

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
 * @param string $data Post content to filter.
 * @param array $extraAttrs Extra attributes to allow.
 *
 * @return string Filtered post content with allowed HTML tags and attributes intact.
 */
function ksesPost(string $data, array $extraAttrs = []): string
{
    global $allowedposttags;

    $tagsInputIncluded = array_merge($allowedposttags, [
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

    return wp_kses($data, $tagsInputIncluded);
}
