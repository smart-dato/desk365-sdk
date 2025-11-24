<?php

namespace SmartDato\Desk365\Requests\TimeEntries;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetTimeEntryDetailsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected int $timeEntryId,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/time_entries/details';
    }

    protected function defaultQuery(): array
    {
        return [
            'time_entry_id' => $this->timeEntryId,
        ];
    }
}
