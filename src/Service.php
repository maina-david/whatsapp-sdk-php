<?php

namespace MainaDavid\WhatsAppSDK;

use GuzzleHttp\Client;

abstract class Service
{
    protected Client $client;

    /**
     * This function is a constructor for the class. It takes a single argument, `$client`, which is an
     * instance of the `GuzzleHttp\Client` class
     * 
     * @param Client $client The client object that is used to make the API calls.
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * It returns an array with a status of 'error' and the data passed to it
     * 
     * @param mixed $data The data you want to send back to the client.
     * 
     * @return array with a status of error and the data passed in.
     */
    protected static function error(mixed $data): array
    {
        return [
            'status'     => 'error',
            'data'        => $data
        ];
    }

    /**
     * It returns an array with a status of success and the data from the API call
     * 
     * @param mixed $data The data you want to send back to the client.
     * 
     * @return array with a status of success and the data from the API call.
     */
    protected static function success(mixed $data): array
    {
        return [
            'status'     => 'success',
            'data'        => json_decode($data->getBody()->getContents())
        ];
    }
}