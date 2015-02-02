<?php

namespace Driebit\Booster\PhpUnit;

use Driebit\Booster\Cleaner;

/**
 * Nulls class properties on test tear down
 */
trait NullOnTearDownTrait
{
    protected function tearDown()
    {
        $cleanup = new Cleaner();
        $cleanup->nullProperties($this);

        parent::tearDown();
    }
}
