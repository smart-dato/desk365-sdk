<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Articles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateArticleRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        // TODO: Add article data parameters or CreateArticleData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/article/create';
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
