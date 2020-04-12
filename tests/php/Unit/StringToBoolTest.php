<?php

declare(strict_types=1);

namespace Widoz\Wp\Functions\Tests\Unit;

use PHPUnit\Framework\ExpectationFailedException;
use ProjectTestsHelper\Phpunit\TestCase;

use SebastianBergmann\RecursionContext\InvalidArgumentException;

use function Widoz\Wp\Functions\stringToBool;

use const PROJECT_BASE_DIR;

class StringToBoolTest extends TestCase
{
    /**
     * @dataProvider stringToBoolDataProvider
     *
     * @param string $string
     * @param bool $expected
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
    public function testStringToBool(string $string, bool $expected): void
    {
        $response = stringToBool($string);

        parent::assertEquals($expected, $response);
    }

    public function stringToBoolDataProvider(): array
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

    /**
     * @inheritDoc
     */
    public function setUp(): void
    {
        parent::setUp();

        require_once PROJECT_BASE_DIR . '/src/formatting.php';
    }
}
