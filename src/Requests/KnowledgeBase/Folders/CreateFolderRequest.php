<?php

namespace SmartDato\Desk365\Requests\KnowledgeBase\Folders;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Traits\Body\HasJsonBody;
use SmartDato\Desk365\Requests\Desk365Request;

class CreateFolderRequest extends Desk365Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct(
        // TODO: Add folder data parameters or CreateFolderData class
    ) {}

    public function resolveEndpoint(): string
    {
        return '/kb/folder/create';
    }

    protected function defaultBody(): array
    {
        // TODO: Implement body
        return [];
    }
}
