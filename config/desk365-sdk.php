<?php

// config for SmartDato/Desk365
return [
    /**
     * The API key for authenticating with the Desk365 API.
     * You can generate this from your Desk365 account settings.
     */
    'api_key' => env('DESK365_API_KEY'),

    /**
     * The base URL for the Desk365 API.
     * This should include the protocol (https://) and domain.
     */
    'base_url' => env('DESK365_BASE_URL', 'https://api.desk365.io'),

    /**
     * The API version to use.
     * Change this if Desk365 releases a new version and you want to use it.
     */
    'version' => env('DESK365_API_VERSION', 'v3'),
];
