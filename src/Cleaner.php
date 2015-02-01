<?php

namespace Driebit\Booster;

class Cleaner
{
    /**
     * Whitelist of items that will not be nulled
     *
     * @var array
     */
    private $whitelist = [
        'PHPUnit_' => 8
    ];

    public function __construct(array $whitelist = [])
    {
        if ($whitelist) {
            $this->whitelist = $whitelist;
        }
    }

    /**
     * Cleans up class properties
     *
     * @param object $object Any object to null properties on
     *
     * @see http://kriswallsmith.net/post/27979797907/get-fast-an-easy-symfony2-phpunit-optimization
     */
    public function nullProperties($object)
    {
        $class = new \ReflectionObject($object);

        foreach ($class->getProperties() as $prop) {
            if (!$prop->isStatic()) {
                foreach ($this->whitelist as $item => $length) {
                    if (0 === strncmp(
                        $prop->getDeclaringClass()->getName(),
                        $item,
                        $length
                    )) {
                        continue 2;
                    }
                }

                $prop->setAccessible(true);
                $prop->setValue($object, null);
            }
        }
    }
}
