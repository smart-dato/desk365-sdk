<?php

namespace SmartDato\Desk365\Data\Tickets;

use Spatie\LaravelData\Data;

class CustomFieldsData extends Data
{
    public function __construct(
        public ?string $clientNumber = null,
        public ?string $shipmentKeyOls = null,
        public ?string $pickupNumberOlp = null,
        public ?string $putawayOmg = null,
        public ?string $epcNumber = null,
    ) {}

    /**
     * Convert to API-ready array.
     *
     * @return array<string, mixed>
     */
    public function toApiArray(): array
    {
        return array_filter([
            'cf_🔡 Clientnumber' => $this->clientNumber,
            'cf_🔑 Shipmentkey OLS' => $this->shipmentKeyOls,
            'cf_📦 Pickup number OLP' => $this->pickupNumberOlp,
            'cf_Putaway OMG' => $this->putawayOmg,
            'cf_📦 EPC Number' => $this->epcNumber,
        ], static fn ($value) => $value !== null);
    }
}
