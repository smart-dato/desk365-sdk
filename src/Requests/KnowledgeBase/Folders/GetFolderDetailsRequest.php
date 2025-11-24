<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Folders;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetFolderDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $folderId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/folder/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'folder_id' => $this->folderId,
        ];
    }
}
