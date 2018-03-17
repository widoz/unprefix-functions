<?php
declare(strict_types=1);

/**
 * Formatting
 *
 * @author  Guido Scialfa <dev@guidoscialfa.com>
 * @package Unprefix\Functions
 * @license GNU General Public License, version 2
 *
 * Copyright (C) 2018 Guido Scialfa <dev@guidoscialfa.com>
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
 * Sanitize Html Class using Array
 *
 * @param array $class The list of the classes to sanitize
 *
 * @return string The sanitized class values
 */
function sanitizeHtmlClassByArray(array $class): string
{
    $class = array_reduce($class, function (string $carry, string $item): string {
        return rtrim($carry, ' ') . ' ' . sanitize_html_class($item);
    }, '');

    return trim($class, ' ');
}

/**
 * Convert String To Boolean
 *
 * This function is the same of wc_string_to_bool.
 *
 * @param string|int $value The string to convert to boolean. 'yes', 1, 'true', '1' are converted
 *                          to true.
 *
 * @return bool True or false depending on the passed value.
 */
function stringToBool(string $value): bool
{
    return (
        'yes' === $value
        || 1 === $value
        || 'true' === $value
        || '1' === $value
        || 'on' === $value
    );
}

/**
 * Convert Boolean to String
 *
 * This function is the same of wc_bool_to_string
 *
 * @param bool $bool The bool value to convert.
 *
 * @return string The converted value. 'yes' or 'no'.
 */
function boolToString(bool $bool): string
{
    return true === $bool ? 'yes' : 'no';
}
