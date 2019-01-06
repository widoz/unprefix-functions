<?php # -*- coding: utf-8 -*-
// phpcs:ignoreFile
declare(strict_types=1);

namespace WordPress\Functions\Tests\Unit;

use ProjectTestsHelper\Phpunit\TestCase;

class StringToBoolTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testStringToBool($testee, $expected)
    {
        $response = \WordPress\Functions\Formatting\stringToBool($testee);

        $this->assertSame($expected, $response);
    }

    public function provider()
    {
        return [
            ['yes', true],
            ['true', true],
            ['on', true],
            ['no', false],
            ['false', false],
            ['off', false],
        ];
    }

    public function setUp()
    {
        parent::setUp();

        require_once TEST_BASE_DIR . '/src/formatting.php';
    }
}
