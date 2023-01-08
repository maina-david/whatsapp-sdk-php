<?php

namespace MainaDavid\WhatsappSdk;

use GuzzleHttp\Client;

class WhatsApp extends service
{
    const BASE_URL = "https://graph.facebook.com/";

    public $url;

    public $accessToken;

    protected $client;

    /**
     * It creates a new instance of the WhatsApp API client
     */
    public function __construct()
    {
        $this->url = self::BASE_URL . config('whatsapp.api_version') . '/' . config('whatsapp.phone_number_id') . '/messages';
        $this->accessToken = config('whatsapp.access_token');

        $this->client = new Client([
            'base_uri' => $this->url,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ]
        ]);
    }

    /**
     * It creates a new message object.
     * 
     * @return A new instance of the Message class.
     */
    public function message()
    {
        $message = new Message($this->client);

        return $message;
    }
}