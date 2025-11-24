<?php

namespace SmartDato\Desk365\Requests\Tickets;

use Saloon\Enums\Method;
use SmartDato\Desk365\Requests\Desk365Request;

class GetTicketsRequest extends Desk365Request
{
    protected Method $method = Method::GET;

    public function __construct(
        protected ?int $ticketCount = null,
        protected ?int $offset = null,
        protected ?bool $includeDescription = null,
        protected ?bool $includeCustomFields = null,
        protected ?bool $includeSurveyDetails = null,
        protected ?int $nestedFields = null,
        protected ?string $orderBy = null,
        protected ?string $orderType = null,
        protected ?string $updatedSince = null,
        protected ?array $filters = null,
    ) {}

    public function resolveEndpoint(): string
    {
        return '/tickets';
    }

    /**
     * @throws \JsonException
     */
    protected function defaultQuery(): array
    {
        $query = array_filter([
            'ticket_count' => $this->ticketCount,
            'offset' => $this->offset,
            'include_description' => $this->includeDescription ? 1 : null,
            'include_custom_fields' => $this->includeCustomFields ? 1 : null,
            'include_survey_details' => $this->includeSurveyDetails ? 1 : null,
            'nested_fields' => $this->nestedFields,
            'order_by' => $this->orderBy,
            'order_type' => $this->orderType,
            'updated_since' => $this->updatedSince,
        ], static fn ($value) => $value !== null);

        if ($this->filters !== null) {
            $query['filters'] = json_encode($this->filters, JSON_THROW_ON_ERROR);
        }

        return $query;
    }
}
