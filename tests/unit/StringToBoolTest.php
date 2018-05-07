<?php # -*- coding: utf-8 -*-
// phpcs:disable

namespace Unprefix\Tests\Unit;

use PHPUnit\Framework\TestCase;

class StringToBoolTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testStringToBool($testee, $expected)
    {
        $response = \Unprefix\Functions\Formatting\stringToBool($testee);

        $this->assertSame($expected, $response);
    }

    public function provider()
    {
        return [
            ['yes', true],
            ['true', true],
            [1, true],
            ['on', true],
            ['no', false],
            ['false', false],
            [0, false],
            ['off', false],
        ];
    }

    public function setUp()
    {
        parent::setUp();

        require_once UNPREFIX_TEST_BASE_DIR . '/src/formatting.php';
    }
}
