<?php

namespace SmartDato\Desk365;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use SmartDato\Desk365\Connector\Desk365Connector;
use SmartDato\Desk365\Exceptions\Desk365Exception;
use SmartDato\Desk365\Exceptions\Desk365FatalRequestException;
use SmartDato\Desk365\Exceptions\Desk365RequestException;
use SmartDato\Desk365\Requests\Ping\PingRequest;

class Desk365
{
    protected Desk365Connector $connector;

    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        ?string $version = null,
    ) {
        $this->connector = new Desk365Connector(
            apiKey: $apiKey,
            baseUrl: $baseUrl,
            version: $version,
        );
    }

    public function connector(): Desk365Connector
    {
        return $this->connector;
    }

    /**
     * @throws Desk365FatalRequestException
     * @throws Desk365RequestException
     * @throws Desk365Exception
     */
    public function ping(): string
    {
        try {
            $response = $this->connector()
                ->send(new PingRequest);
        } catch (FatalRequestException $e) {
            throw new Desk365FatalRequestException($e->getMessage());
        } catch (RequestException $e) {
            throw new Desk365RequestException($e->getMessage());
        }

        if ($response->failed()) {
            throw new Desk365Exception(
                message: $response->body(),
                code: $response->status(),
            );
        }

        return $response->body();
    }
}
