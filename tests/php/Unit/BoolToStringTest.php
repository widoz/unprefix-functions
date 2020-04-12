<?php

declare(strict_types=1);

namespace Widoz\Wp\Functions\Tests\Unit;

use Generator;
use PHPUnit\Framework\ExpectationFailedException;
use ProjectTestsHelper\Phpunit\TestCase;

use SebastianBergmann\RecursionContext\InvalidArgumentException;

use function Widoz\Wp\Functions\boolToString;

/**
 * @test boolToString
 */
class BoolToStringTest extends TestCase
{
    /**
     * @dataProvider boolToStringReturnsYesDataProvider
     *
     * @param bool $value
     * @param string $expected
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testBoolToStringReturns(bool $value, string $expected): void
    {
        $result = boolToString($value);

        parent::assertEquals($expected, $result);
    }

    public function boolToStringReturnsYesDataProvider(): array
    {
        return [
            [true, 'yes'],
            [false, 'no'],
        ];
    }

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        require_once PROJECT_BASE_DIR . '/src/formatting.php';
    }
}
