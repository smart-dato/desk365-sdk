<?php

namespace SmartDato\Desk365\Data\Tickets;

use Spatie\LaravelData\Data;

class CustomFieldsData extends Data
{
    /**
     * @var array<string, mixed>
     */
    protected array $fields = [];

    /**
     * @param  array<string, mixed>  $fields
     */
    public function __construct(array $fields = [])
    {
        $this->fields = $fields;
    }

    /**
     * Set a custom field value.
     *
     * @param  string  $key  The custom field key (e.g., 'cf_🔡 Clientnumber')
     * @param  mixed  $value  The value to set
     */
    public function set(string $key, mixed $value): self
    {
        $this->fields[$key] = $value;

        return $this;
    }

    /**
     * Get a custom field value.
     *
     * @param  string  $key  The custom field key
     * @param  mixed  $default  Default value if key doesn't exist
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $this->fields[$key] ?? $default;
    }

    /**
     * Check if a custom field exists.
     *
     * @param  string  $key  The custom field key
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->fields);
    }

    /**
     * Remove a custom field.
     *
     * @param  string  $key  The custom field key
     */
    public function remove(string $key): self
    {
        unset($this->fields[$key]);

        return $this;
    }

    /**
     * Get all custom fields.
     *
     * @return array<string, mixed>
     */
    public function all(): array
    {
        return $this->fields;
    }

    /**
     * Set multiple custom fields at once.
     *
     * @param  array<string, mixed>  $fields
     */
    public function merge(array $fields): self
    {
        $this->fields = array_merge($this->fields, $fields);

        return $this;
    }

    /**
     * Convert to API-ready array.
     * Filters out null values.
     *
     * @return array<string, mixed>
     */
    public function toApiArray(): array
    {
        return array_filter($this->fields, static fn ($value) => $value !== null);
    }
}
