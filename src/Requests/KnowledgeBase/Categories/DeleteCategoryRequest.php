<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Categories;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class DeleteCategoryRequest extends Desk365Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $categoryId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/category/delete';
    }

    protected function defaultQuery(): array
    {
        return [
            'category_id' => $this->categoryId,
        ];
    }
}
