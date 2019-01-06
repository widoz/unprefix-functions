<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace WordPress\Functions\Tests\Unit;

use ProjectTestsHelper\Phpunit\TestCase;

class BoolToStringTest extends TestCase
{
    public function testBoolToStringReturnsYes()
    {
        $response = \WordPress\Functions\Formatting\boolToString(true);

        $this->assertSame('yes', $response);
    }

    public function testBoolToStringReturnsNo()
    {
        $response = \WordPress\Functions\Formatting\boolToString(false);

        $this->assertSame('no', $response);
    }

    public function setUp()
    {
        parent::setUp();

        require_once TEST_BASE_DIR . '/src/formatting.php';
    }
}
