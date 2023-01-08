<?php

namespace MainaDavid\WhatsappSdk;

use GuzzleHttp\Client;

class WhatsApp extends service
{
    const BASE_URL = "https://graph.facebook.com/";

    public $baseUrl;

    protected $messageUrl;

    public $accessToken;

    protected $messageClient;


    /**
     * It creates a new instance of the WhatsApp API client
     */
    public function __construct()
    {
        $this->baseUrl = self::BASE_URL . config('whatsapp.api_version') . '/' . config('whatsapp.phone_number_id');
        $this->accessToken = config('whatsapp.access_token');

        $this->messageUrl = $this->baseUrl . '/messages';

        $this->messageClient = new Client([
            'base_uri' => $this->messageUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json'
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
        $message = new Message($this->messageClient);

        return $message;
    }
}