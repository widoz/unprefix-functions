<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Unprefix\Tests\Unit;

use \Brain\Monkey;
use ProjectTestsHelper\Phpunit\TestCase;

class HtmlSanitizeClassByArrayTest extends TestCase
{
    public function testValidClassValue()
    {
        Monkey\Functions\expect('sanitize_html_class')
            ->times(5)
            ->andReturnFirstArg();

        $data = [
            'class-one',
            'class-two',
            'class-three',
            '',
            'class-five',
        ];

        $response = \WordPress\Functions\Formatting\sanitizeHtmlClassByArray($data);

        $this->assertSame('class-one class-two class-three class-five', $response);
    }

    public function setUp()
    {
        parent::setUp();

        require_once TEST_BASE_DIR . '/src/formatting.php';
    }
}
