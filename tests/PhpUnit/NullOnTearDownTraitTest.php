<?php

namespace Driebit\Booster\Tests;

use Driebit\Booster\PhpUnit\NullOnTearDownTrait;

class NullOnTearDownTraitTest extends \PHPUnit_Framework_TestCase
{
    use NullOnTearDownTrait;

    protected $variable = 'something';

    public function testTearDown()
    {
        $this->tearDown();
        $this->assertNull($this->variable);
    }
}
