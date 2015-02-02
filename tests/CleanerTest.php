<?php

namespace Driebit\Booster\Tests {
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
            $this->assertEquals('whitelisted', $object->whitelisted);
        }
    }

    class SillyObject extends \PHPUnit_Whitelisted
    {
        public $publicProp = 'public';
        protected $protectedProp = 'protected';
        public static $staticProp = 'static';

        public function getProtectedProp()
        {
            return $this->protectedProp;
        }
    }
}

namespace
{
    class PHPUnit_Whitelisted
    {
        public $whitelisted = 'whitelisted';
    }

}
