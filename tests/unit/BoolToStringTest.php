<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Unprefix\Tests\Unit;

use ProjectTestsHelper\Phpunit\TestCase;

class BoolToStringTest extends TestCase
{
    public function testBoolToStringReturnsYes()
    {
        $response = \Unprefix\Functions\Formatting\boolToString(true);

        $this->assertSame('yes', $response);
    }

    public function testBoolToStringReturnsNo()
    {
        $response = \Unprefix\Functions\Formatting\boolToString(false);

        $this->assertSame('no', $response);
    }

    public function setUp()
    {
        parent::setUp();

        require_once TEST_BASE_DIR . '/src/formatting.php';
    }
}
