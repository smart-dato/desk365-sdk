<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\Desk365\Desk365;
use SmartDato\Desk365\Requests\Ping\PingRequest;

it('can ping', function () {
    MockClient::global([
        PingRequest::class => MockResponse::fixture('Ping/PingRequest'),
    ]);

    $response = new Desk365(
        '6f1ff4cb51667adc780e5e417b3934711e1b2b88ab3fd2252b84669ccc734b63',
        'https://omest.desk365.io/apis/',
    )->ping();

    expect($response)
        ->toBe('All good! Desk365 APIs are running fine');
});
