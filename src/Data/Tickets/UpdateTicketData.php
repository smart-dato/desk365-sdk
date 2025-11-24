<?php

namespace SmartDato\Desk365\Data\Tickets;

use SmartDato\Desk365\Enums\Tickets\TicketPriority;
use SmartDato\Desk365\Enums\Tickets\TicketStatus;
use SmartDato\Desk365\Enums\Tickets\TicketType;
use Spatie\LaravelData\Data;

class UpdateTicketData extends Data
{
    public function __construct(
        public ?string $subject = null,
        public ?string $description = null,
        public ?string $sla = null,
        public ?TicketStatus $status = null,
        public ?TicketPriority $priority = null,
        public ?TicketType $type = null,
        public ?string $assignTo = null,
        public ?string $group = null,
        public ?string $category = null,
        public ?string $subCategory = null,
        public ?CustomFieldsData $customFields = null,
        public ?WatchersData $watchers = null,
        public ?ShareToData $shareTo = null,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public function toApiArray(): array
    {
        return array_filter([
            'subject' => $this->subject,
            'description' => $this->description,
            'sla' => $this->sla,
            'status' => $this->status?->value,
            'priority' => $this->priority?->value,
            'type' => $this->type?->value,
            'assign_to' => $this->assignTo,
            'group' => $this->group,
            'category' => $this->category,
            'sub_category' => $this->subCategory,
            'custom_fields' => $this->customFields?->toApiArray(),
            'watchers' => $this->watchers?->toApiArray(),
            'share_to' => $this->shareTo?->toApiArray(),
        ], static fn ($value) => $value !== null);
    }
}
