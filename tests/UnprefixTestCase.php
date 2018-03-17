<?php
// phpcs:disable
namespace Unprefix\Tests;

use Brain\Monkey;
use PHPUnit\Framework\TestCase;

class UnprefixTestCase extends TestCase
{
    protected function setUp()
    {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown()
    {
        Monkey\tearDown();
        \Mockery::close();
        parent::tearDown();
    }
}
