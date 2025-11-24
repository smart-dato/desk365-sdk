<?php

namespace SmartDato\Desk365\Requests\Ping;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class PingRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/ping';
    }
}
