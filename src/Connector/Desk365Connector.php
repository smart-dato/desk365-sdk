<?php

namespace SmartDato\Desk365\Connector;

use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class Desk365Connector extends Connector
{
    use AcceptsJson;

    public function __construct(
        protected ?string $apiKey = null,
        protected ?string $baseUrl = null,
        protected ?string $version = null,
    ) {}

    public function resolveBaseUrl(): string
    {
        $url = $this->baseUrl ?? config('desk365-sdk.base_url', 'https://api.desk365.io');
        $version = $this->version ?? config('desk365-sdk.version', 'v3');

        return $url.ltrim($version, '/');
    }

    protected function defaultHeaders(): array
    {
        $apiKey = $this->apiKey ?? config('desk365-sdk.api_key');

        return [
            'Authorization' => $apiKey,
            'Accept' => 'application/json',
        ];
    }
}
