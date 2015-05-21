<?php namespace Coderjp\Notify\Facades;

/**
 * This file is part of Notify,
 *
 * @license MIT
 * @package Coderjp\Notify
 */

use Illuminate\Support\Facades\Facade;

class Notify extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'notify';
    }
}