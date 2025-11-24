<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Articles;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class DeleteArticleRequest extends Desk365Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $articleId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/article/delete';
    }

    protected function defaultQuery(): array
    {
        return [
            'article_id' => $this->articleId,
        ];
    }
}
