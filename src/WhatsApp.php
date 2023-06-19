<?php

namespace MainaDavid\WhatsAppSDK;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class WhatsApp
{
    const BASE_URL = "https://graph.facebook.com/";

    public string $baseUrl;

    public mixed $accessToken;

    protected Client $client;

    /**
     * It creates a new instance of the WhatsApp API client
     * @throws Exception
     */
    public function __construct($phoneNumberId = null, $accessToken = null, $apiVersion = null)
    {
        $phoneNumberId = $phoneNumberId ?? config('whatsapp.phone_number_id');
        $accessToken = $accessToken ?? config('whatsapp.access_token');
        $apiVersion = $apiVersion ?? config('whatsapp.api_version');

        if (empty($phoneNumberId) || empty($accessToken) || empty($apiVersion)) {
            throw new Exception('phone_number_id, access_token, or api_version is not set');
        }

        $this->baseUrl = self::BASE_URL . $apiVersion . '/' . $phoneNumberId . '/';
        $this->accessToken = $accessToken;

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
    protected function createMessage(): Message
    {
        return new Message($this->client);
    }

    /**
     * Send a text message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number) and 'message' (text message).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendTextMessage(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendTextMessage($params);
    }

    /**
     * Send a reply to a text message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'message' (text message), and 'message_id' (original message ID).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToTextMessage(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendReplyToTextMessage($params);
    }

    /**
     * Send a media message by URL using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number) and 'media_url' (URL of the media file).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendMediaMessageByURL(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendMediaMessageByURL($params);
    }

    /**
     * Send a media message by ID using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number) and 'media_id' (ID of the media file).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendMediaMessageByID(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendMediaMessageByID($params);
    }

    /**
     * Send a reply to a media message by URL using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'message' (text message), 'media_url' (URL of the media file), and 'message_id' (original message ID).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToMediaMessageByURL(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendReplyToMediaMessageByURL($params);
    }

    /**
     * Send a reply to a media message by ID using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'message' (text message), 'media_id' (ID of the media file), and 'message_id' (original message ID).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToMediaMessageByID(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendReplyToMediaMessageByID($params);
    }

    /**
     * Send a location message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'latitude' (latitude coordinate), and 'longitude' (longitude coordinate).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendLocationMessage(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendLocationMessage($params);
    }

    /**
     * Send a reply to a location message using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'to' (phone number), 'latitude' (latitude coordinate), 'longitude' (longitude coordinate), and 'message_id' (original message ID).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToLocationMessage(array $params): array
    {
        $message = $this->createMessage();
        return $message->sendReplyToLocationMessage($params);
    }

    /**
     * Mark a message as read using the WhatsApp API.
     *
     * @param array $params An array of parameters including 'message_id' (message ID).
     * @return array The response from the API.
     * @throws GuzzleException
     */
    public function markMessageAsRead(array $params): array
    {
        $message = $this->createMessage();
        return $message->markMessageAsRead($params);
    }
}