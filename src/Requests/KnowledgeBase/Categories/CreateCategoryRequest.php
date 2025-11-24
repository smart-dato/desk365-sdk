<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Categories;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateCategoryRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        // TODO: Add category data parameters or CreateCategoryData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/category/create';
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
