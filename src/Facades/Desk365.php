<?php

namespace SmartDato\Desk365\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \SmartDato\Desk365\Desk365
 */
class Desk365 extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \SmartDato\Desk365\Desk365::class;
    }
}
