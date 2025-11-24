<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Articles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class UpdateArticleRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::PUT;

    public function __construct(
        protected int $articleId,
        // TODO: Add update data parameters or UpdateArticleData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/article/update';
    }

    protected function defaultQuery(): array
    {
        return [
            'article_id' => $this->articleId,
        ];
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
