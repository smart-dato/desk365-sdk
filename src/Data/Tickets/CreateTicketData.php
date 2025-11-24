<?php

namespace SmartDato\Desk365\Data\Tickets;

use SmartDato\Desk365\Enums\Tickets\TicketCategory;
use SmartDato\Desk365\Enums\Tickets\TicketGroup;
use SmartDato\Desk365\Enums\Tickets\TicketPriority;
use SmartDato\Desk365\Enums\Tickets\TicketStatus;
use SmartDato\Desk365\Enums\Tickets\TicketType;
use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapOutputName(SnakeCaseMapper::class)]
class CreateTicketData extends Data
{
    public function __construct(
        public string $email,
        public string $subject,
        public string $description,
        public ?string $formName = null,
        public ?TicketStatus $status = null,
        public ?TicketPriority $priority = null,
        public ?TicketType $type = null,
        public ?string $assignTo = null,
        public ?TicketGroup $group = null,
        public ?TicketCategory $category = null,
        public ?string $subCategory = null,
        public ?CustomFieldsData $customFields = null,
        /** @var array<string>|null */
        public ?array $watchers = null,
        /** @var array<string>|null */
        public ?array $shareTo = null,
    ) {}

    /**
     * Convert to API-ready array with snake_case keys.
     *
     * @return array<string, mixed>
     */
    public function toApiArray(): array
    {
        return array_filter([
            'email' => $this->email,
            'subject' => $this->subject,
            'description' => $this->description,
            'form_name' => $this->formName,
            'status' => $this->status?->value,
            'priority' => $this->priority?->value,
            'type' => $this->type?->value,
            'assign_to' => $this->assignTo,
            'group' => $this->group?->value,
            'category' => $this->category?->value,
            'sub_category' => $this->subCategory,
            'custom_fields' => $this->customFields?->toApiArray(),
            'watchers' => $this->watchers,
            'share_to' => $this->shareTo,
        ], static fn ($value) => $value !== null);
    }
}
