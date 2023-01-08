<?php

return [
    /* Setting the default version of the API to v15.0. */
    'api_version' => env('GRAPH_API_VERSION', 'v15.0'),

    /* This is the phone number ID that you will be using to send messages. */
    'phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID'),

    /* This is the access token that you will be using to send messages. */
    'access_token' => env('WHATSAPP_ACCESS_TOKEN'),
];