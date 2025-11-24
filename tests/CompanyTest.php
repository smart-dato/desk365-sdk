<?php

use Saloon\Http\Faking\MockClient;
use Saloon\Http\Faking\MockResponse;
use SmartDato\Desk365\Desk365;
use SmartDato\Desk365\Requests\Companies\GetCompaniesRequest;
use SmartDato\Desk365\Requests\Companies\GetCompanyDetailsRequest;

beforeEach(function () {
    $this->desk = new Desk365;
});

it('can get companies and details', function () {
    MockClient::global([
        GetCompaniesRequest::class => MockResponse::fixture('Companies/GetCompaniesRequest'),
        GetCompanyDetailsRequest::class => MockResponse::fixture('Companies/GetCompanyDetailsRequest'),
    ]);

    $companies = $this->desk->connector()->send(
        new GetCompaniesRequest
    );

    expect($companies->status())->toBe(200)
        ->and($companies->json())->toHaveKey('content');

    $company = $this->desk->connector()->send(
        new GetCompanyDetailsRequest(
            $companies->json('content.1.name')
        )
    );

    expect($company->status())->toBe(200)
        ->and($company->json('name'))->toBe($companies->json('content.1.name'));
});
