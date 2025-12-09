# CustomFieldsData Usage Examples

The `CustomFieldsData` class has been refactored to be flexible and support dynamic custom field keys.

## Basic Usage

### Array Constructor

```php
$customFields = new CustomFieldsData([
    'cf_🔡 Clientnumber' => '12345',
    'cf_🔑 Shipmentkey OLS' => 'OLS-001',
    'cf_📦 Pickup number OLP' => 'ABC-123',
]);
```

### Using Setters

```php
$customFields = new CustomFieldsData();
$customFields
    ->set('cf_🔡 Clientnumber', '12345')
    ->set('cf_🔑 Shipmentkey OLS', 'OLS-001')
    ->set('cf_📦 EPC Number', 'EPC-789');
```

### Using Getters

```php
$clientNumber = $customFields->get('cf_🔡 Clientnumber');
$shipmentKey = $customFields->get('cf_🔑 Shipmentkey OLS', 'default-value');
```

## Available Methods

### `set(string $key, mixed $value): self`
Set a single custom field value. Returns `$this` for method chaining.

### `get(string $key, mixed $default = null): mixed`
Get a custom field value. Returns `$default` if the key doesn't exist.

### `has(string $key): bool`
Check if a custom field exists.

### `remove(string $key): self`
Remove a custom field. Returns `$this` for method chaining.

### `all(): array`
Get all custom fields as an array.

### `merge(array $fields): self`
Merge multiple custom fields at once. Returns `$this` for method chaining.

```php
$customFields->merge([
    'cf_Field1' => 'value1',
    'cf_Field2' => 'value2',
]);
```

### `toApiArray(): array`
Convert to API-ready array (filters out null values).

## Usage in Ticket Creation

```php
$ticket = new CreateTicketData(
    email: 'user@example.com',
    subject: 'Issue with shipment',
    description: 'Description here',
    customFields: new CustomFieldsData([
        'cf_🔡 Clientnumber' => '12345',
        'cf_🔑 Shipmentkey OLS' => 'OLS-001',
        'cf_📦 Pickup number OLP' => 'PICKUP-456',
    ])
);
```

## Dynamic Field Management

```php
// Start with some fields
$customFields = new CustomFieldsData([
    'cf_Field1' => 'value1',
]);

// Add more fields dynamically
$customFields->set('cf_Field2', 'value2');

// Check if field exists
if ($customFields->has('cf_Field1')) {
    // Do something
}

// Get all fields
$allFields = $customFields->all();

// Remove a field
$customFields->remove('cf_Field1');
```

## Benefits

- **Flexible**: Add any custom field without modifying the class
- **Type-safe**: Uses PHP type hints for parameters
- **Chainable**: Most methods return `$this` for fluent interfaces
- **Array-compatible**: Can initialize with an array or build dynamically
- **Easy migration**: Simply change from named parameters to array keys
