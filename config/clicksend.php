<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'username' => env('CLICKSEND_USERNAME'),
    'password' => env('CLICKSEND_PASSWORD'),
    'api_endpoint' => env('CLICKSEND_API_ENDPOINT', 'https://rest.clicksend.com/v3')
];
