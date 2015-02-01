<?php

namespace Driebit\Booster\Symfony;

/**
 * Disable debug mode after the first kernel initialization
 *
 * When debug is enabled, Symfony will check the filesystem for changes to
 * service configuration resources. By disabling debug after the container has
 * been initialized for the first time, these checks will not be carried out.
 *
 * @see http://kriswallsmith.net/post/27979797907/get-fast-an-easy-symfony2-phpunit-optimization
 */
trait NoDebugTrait
{
    public static $forceDebug = false;

    /**
     * Disable debug mode after the first container initialization
     */
    protected function initializeContainer()
    {
        static $first = true;

        if ('test' !== $this->getEnvironment()) {
            return parent::initializeContainer();
        }

        $debug = $this->debug;

        if (!$first && !self::$forceDebug) {
            // disable debug mode on all but the first initialization
            $this->debug = false;
        }

        // will not work with --process-isolation
        $first = false;

        try {
            parent::initializeContainer();
        } catch (\Exception $e) {
            $this->debug = $debug;
            throw $e;
        }

        $this->debug = $debug;
    }
}
