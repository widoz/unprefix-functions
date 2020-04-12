<?php

declare(strict_types=1);

if (!function_exists('sanitize_html_class')) {
    function sanitize_html_class($class)
    {
    }
}

if (!function_exists('wp_kses')) {
    function wp_kses($string, $allowed_html, $allowed_protocols = array())
    {
    }
}
