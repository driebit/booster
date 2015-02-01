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

        $this->assertEquals('static', $object::$staticProp);
        $this->assertNull($object->publicProp);
        $this->assertNull($object->getProtectedProp());
    }
}

class SillyObject
{
    public $publicProp = 'public';
    protected $protectedProp = 'protected';
    protected $PHPUnit_whitelisted = 'whitelisted';
    public static $staticProp = 'static';

    public function getProtectedProp()
    {
        return $this->protectedProp;
    }
}
