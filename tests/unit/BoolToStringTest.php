<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Unprefix\Tests\Unit;

use Unprefix\Tests\UnprefixTestCase;

class BoolToStringTest extends UnprefixTestCase
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

        require_once UNPREFIX_TEST_BASE_DIR . '/src/formatting.php';
    }
}
