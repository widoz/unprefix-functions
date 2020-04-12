<?php

declare(strict_types=1);

namespace Widoz\Wp\Functions\Tests\Unit;

use ProjectTestsHelper\Phpunit\TestCase;

use function Brain\Monkey\Functions\expect;
use function Widoz\Wp\Functions\sanitizeHtmlClassByArray;

use const PROJECT_BASE_DIR;

/**
 * @test htmlSanitizeClassByArray
 */
class HtmlSanitizeClassByArrayTest extends TestCase
{
    public function testValidClassValue()
    {
        $data = [
            'class-one',
            'class-two',
            'class-three',
            '',
            'class-five',
        ];

        expect('sanitize_html_class')->withAnyArgs()->andReturnFirstArg();

        $response = sanitizeHtmlClassByArray($data);

        parent::assertSame('class-one class-two class-three class-five', $response);
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
