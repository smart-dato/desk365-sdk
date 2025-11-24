<?php

namespace SmartDato\Desk365\Data\Tickets;

use Spatie\LaravelData\Data;

class ShareToData extends Data
{
    public function __construct(
        /** @var array<string>|null */
        public ?array $add = null,
        /** @var array<string>|null */
        public ?array $remove = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toApiArray(): array
    {
        return array_filter([
            'add' => $this->add,
            'remove' => $this->remove,
        ], static fn ($value) => $value !== null);
    }
}
