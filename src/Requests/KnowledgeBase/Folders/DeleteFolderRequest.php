<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Folders;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class DeleteFolderRequest extends Desk365Request
{
    protected Method $method = Method::DELETE;

    public function __construct(
        protected int $folderId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/folder/delete';
    }

    protected function defaultQuery(): array
    {
        return [
            'folder_id' => $this->folderId,
        ];
    }
}
