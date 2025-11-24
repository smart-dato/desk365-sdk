<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Categories;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateCategoryRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $categoryId,
        // TODO: Add update data parameters or UpdateCategoryData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/category/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'category_id' => $this->categoryId,
        ];
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
