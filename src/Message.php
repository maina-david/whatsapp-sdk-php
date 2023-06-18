<?php

namespace MainaDavid\WhatsAppSDK;

use GuzzleHttp\Exception\GuzzleException;

class Message extends Service
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    /**
     * It sends a text message to a recipient
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendTextMessage(array $options): array
    {
        if (empty($options['to']) || empty($options['message'])) {
            return $this->error('recipient and message must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $options['message']
            ]
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * It sends a text message to a recipient
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToTextMessage(array $options): array
    {
        if (empty($options['to']) || empty($options['message_id']) || empty($options['message'])) {
            return $this->error('recipient, message ID and message must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'context' => [
                'message_id' => $options['message_id']
            ],
            'type' => 'text',
            'text' => [
                'preview_url' => false,
                'body' => $options['message']
            ]
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * It sends a media message to a recipient using a URL
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendMediaMessageByURL(array $options): array
    {
        if (empty($options['to']) || empty($options['type']) || empty($options['url'])) {
            return $this->error('recipient, media type and media url must be defined');
        }

        if (!filter_var($options['url'], FILTER_VALIDATE_URL)) {
            return $this->error('media url is not a valid url');
        }

        if (!in_array($options['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'type' => $options['type'],
            $options['type'] => [
                'link' => $options['url']
            ]
        ];

        if ($options['type'] == 'image' || $options['type'] == 'video') {
            if (!empty($options['caption'])) {
                $data[$options['type']]['caption'] = $options['caption'];
            }
        }

        if ($options['type'] == 'document') {
            if (!empty($options['filename'])) {
                $data[$options['type']]['filename'] = $options['filename'];
            }
        }

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Send a media message to a recipient by media ID
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendMediaMessageByID(array $options): array
    {
        if (empty($options['to']) || empty($options['type']) || empty($options['media_id'])) {
            return $this->error('recipient, media type and media ID must be defined');
        }

        if (!in_array($options['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'type' => $options['type'],
            $options['type'] => [
                'id' => $options['media_id']
            ]
        ];

        if ($options['type'] == 'image' || $options['type'] == 'video') {
            if (!empty($options['caption'])) {
                $data[$options['type']]['caption'] = $options['caption'];
            }
        }

        if ($options['type'] == 'document') {
            if (!empty($options['filename'])) {
                $data[$options['type']]['filename'] = $options['filename'];
            }
        }

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Send a reply to a media message by URL
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToMediaMessageByURL(array $options): array
    {
        if (empty($options['to']) || empty($options['type']) || empty($options['url']) || empty($options['message_id'])) {
            return $this->error('recipient, media type, message ID and media url must be defined');
        }

        if (!filter_var($options['url'], FILTER_VALIDATE_URL)) {
            return $this->error('media url is not a valid url');
        }

        if (!in_array($options['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'context' => [
                'message_id' => $options['message_id']
            ],
            'type' => $options['type'],
            $options['type'] => [
                'link' => $options['url']
            ]
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Send a reply to a media message by ID
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToMediaMessageByID(array $options): array
    {
        if (empty($options['to']) || empty($options['type']) || empty($options['media_id']) || empty($options['message_id'])) {
            return $this->error('recipient, media type, message ID and media ID must be defined');
        }

        if (!in_array($options['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'context' => [
                'message_id' => $options['message_id']
            ],
            'type' => $options['type'],
            $options['type'] => [
                'id' => $options['media_id']
            ]
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Send a location message to a recipient
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendLocationMessage(array $options): array
    {
        if (empty($options['to']) || empty($options['latitude']) || empty($options['longitude']) || empty($options['name']) || empty($options['address'])) {
            return $this->error('recipient, latitude, longitude, name and address must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'type' => 'location',
            'location' => [
                'latitude' => $options['latitude'],
                'longitude' => $options['longitude'],
                'name' => $options['name'],
                'address' => $options['address']
            ]
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * Send a location message to a recipient
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function sendReplyToLocationMessage(array $options): array
    {
        if (empty($options['to']) || empty($options['latitude']) || empty($options['longitude']) || empty($options['name']) || empty($options['address']) || empty($options['message_id'])) {
            return $this->error('recipient, latitude, longitude, name, address and message ID must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            'context' => [
                'message_id' => $options['message_id']
            ],
            'type' => 'location',
            'location' => [
                'latitude' => $options['latitude'],
                'longitude' => $options['longitude'],
                'name' => $options['name'],
                'address' => $options['address']
            ]
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }

    /**
     * It marks a message as read
     *
     * @param array $options
     *
     * @return array response from the API.
     * @throws GuzzleException
     */
    public function markMessageAsRead(array $options): array
    {
        if (empty($options['message_id'])) {
            return $this->error('message ID must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            'message_id' => $options['message_id']
        ];

        try {
            $response = $this->client->post('messages', ['form_params' => $data]);

            return $this->success($response);
        }catch (\Exception $e){
            return $this->error($e->getMessage());
        }
    }
}