<?php

namespace Driebit\Booster\Tests;

use Driebit\Booster\Cleaner;

class CleanerTest extends \PHPUnit_Framework_TestCase
{
    public function testNullProperties()
    {
        $object = new SillyObject();

        $cleaner = new Cleaner();
        $cleaner->nullProperties($object);

        $this->assertNull($object->publicProp);
        $this->assertNull($object->getProtectedProp());
        $this->assertEquals('static', $object::$staticProp);
        $this->assertEquals('whitelisted', $object->PHPUnit_whitelisted);

    }
}

class SillyObject
{
    public $publicProp = 'public';
    protected $protectedProp = 'protected';
    public $PHPUnit_whitelisted = 'whitelisted';
    public static $staticProp = 'static';

    public function getProtectedProp()
    {
        return $this->protectedProp;
    }
}
