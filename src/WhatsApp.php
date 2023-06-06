<?php

namespace MainaDavid\WhatsAppSDK;

use GuzzleHttp\Client;

class WhatsApp
{
    const BASE_URL = "https://graph.facebook.com/";

    public $baseUrl;

    public $accessToken;

    protected $client;

    /**
     * It creates a new instance of the WhatsApp API client
     */
    public function __construct()
    {
        $this->baseUrl = self::BASE_URL . config('whatsapp.api_version') . '/' . config('whatsapp.phone_number_id') . '/';
        $this->accessToken = config('whatsapp.access_token');

        $this->client = new Client([
            'base_uri' => $this->baseUrl,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->accessToken,
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * Helper method to instantiate the Message class
     *
     * @return Message An instance of the Message class
     */
    protected function createMessage()
    {
        return new Message($this->client);
    }

    /**
     * Send a text message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number) and 'message' (text message).
     * @return mixed The response from the API.
     */
    public function sendTextMessage(array $params)
    {
        $message = $this->createMessage();
        return $message->sendTextMessage($params);
    }

    /**
     * Send a reply to a text message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'message' (text message), and 'message_id' (original message ID).
     * @return mixed The response from the API.
     */
    public function sendReplyToTextMessage(array $params)
    {
        $message = $this->createMessage();
        return $message->sendReplyToTextMessage($params);
    }

    /**
     * Send a media message by URL using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number) and 'media_url' (URL of the media file).
     * @return mixed The response from the API.
     */
    public function sendMediaMessageByURL(array $params)
    {
        $message = $this->createMessage();
        return $message->sendMediaMessageByURL($params);
    }

    /**
     * Send a media message by ID using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number) and 'media_id' (ID of the media file).
     * @return mixed The response from the API.
     */
    public function sendMediaMessageByID(array $params)
    {
        $message = $this->createMessage();
        return $message->sendMediaMessageByID($params);
    }

    /**
     * Send a reply to a media message by URL using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'message' (text message), 'media_url' (URL of the media file), and 'message_id' (original message ID).
     * @return mixed The response from the API.
     */
    public function sendReplyToMediaMessageByURL(array $params)
    {
        $message = $this->createMessage();
        return $message->sendReplyToMediaMessageByURL($params);
    }

    /**
     * Send a reply to a media message by ID using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'message' (text message), 'media_id' (ID of the media file), and 'message_id' (original message ID).
     * @return mixed The response from the API.
     */
    public function sendReplyToMediaMessageByID(array $params)
    {
        $message = $this->createMessage();
        return $message->sendReplyToMediaMessageByID($params);
    }

    /**
     * Send a location message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'latitude' (latitude coordinate), and 'longitude' (longitude coordinate).
     * @return mixed The response from the API.
     */
    public function sendLocationMessage(array $params)
    {
        $message = $this->createMessage();
        return $message->sendLocationMessage($params);
    }

    /**
     * Send a reply to a location message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'latitude' (latitude coordinate), 'longitude' (longitude coordinate), and 'message_id' (original message ID).
     * @return mixed The response from the API.
     */
    public function sendReplyToLocationMessage(array $params)
    {
        $message = $this->createMessage();
        return $message->sendReplyToLocationMessage($params);
    }

    /**
     * Mark a message as read using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'message_id' (message ID).
     * @return mixed The response from the API.
     */
    public function markMessageAsRead(array $params)
    {
        $message = $this->createMessage();
        return $message->markMessageAsRead($params);
    }
}