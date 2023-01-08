<?php

namespace MainaDavid\WhatsappSdk;

class Message extends service
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    /**
     * It sends a text message to a recipient
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendTextMessage($content)
    {
        if (empty($content['to']) || empty($content['message'])) {
            return $this->error('recipient and message must be defined');
        }

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $content['to'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => $content['message']
            ]
        ];

        $response = $this->client->post($data);

        return $this->success($response);
    }

    /**
     * It sends a text message to a recipient
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendReplytoTextMessage($content)
    {
        if (empty($content['to']) || empty($content['message_id']) || empty($content['message'])) {
            return $this->error('recipient, message ID and message must be defined');
        }

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $content['to'],
            "context" => [
                "message_id" => $content['message_id']
            ],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => $content['message']
            ]
        ];

        $response = $this->client->post($data);

        return $this->success($response);
    }

    /**
     * It sends a media message to a recipient using a URL
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendMediaMessageByURL($content)
    {
        if (empty($content['to']) || empty($content['type']) || empty($content['url'])) {
            return $this->error('recipient, media type and media url must be defined');
        }

        if (!filter_var($content['url'], FILTER_VALIDATE_URL)) {
            return $this->error('media url is not a valid url');
        }

        if (!in_array($content['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $content['to'],
            'type' => $content['type'],
            $content['type'] => [
                'link' => $content['url']
            ]
        ];

        $response = $this->client->post($data);

        return $this->success($response);
    }

    /**
     * Send a media message to a recipient by media ID
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendMediaMessageByID($content)
    {
        if (empty($content['to']) || empty($content['type']) || empty($content['media_id'])) {
            return $this->error('recipient, media type and media ID must be defined');
        }

        if (!in_array($content['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $content['to'],
            'type' => $content['type'],
            $content['type'] => [
                'id' => $content['media_id']
            ]
        ];

        $response = $this->client->post($data);

        return $this->success($response);
    }

    /**
     * Send a reply to a media message by URL
     * 
     * @param content This is the array of parameters that you want to send to the API.
     * 
     * @return The response from the API.
     */
    public function sendReplytoMediaMessageByURL($content)
    {
        if (empty($content['to']) || empty($content['type']) || empty($content['url']) || empty($content['message_id'])) {
            return $this->error('recipient, media type, message ID and media url must be defined');
        }

        if (!filter_var($content['url'], FILTER_VALIDATE_URL)) {
            return $this->error('media url is not a valid url');
        }

        if (!in_array($content['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $content['to'],
            "context" => [
                "message_id" => $content['message_id']
            ],
            'type' => $content['type'],
            $content['type'] => [
                'link' => $content['url']
            ]
        ];

        $response = $this->client->post($data);

        return $this->success($response);
    }

    /**
     * Send a reply to a media message by ID
     * 
     * @param content This is the array of parameters that you want to send to the API.
     * 
     * @return The response from the API.
     */
    public function sendReplytoMediaMessageByID($content)
    {
        if (empty($content['to']) || empty($content['type']) || empty($content['media_id']) || empty($content['message_id'])) {
            return $this->error('recipient, media type, message ID and media ID must be defined');
        }

        if (!in_array($content['type'], ['image', 'document', 'audio', 'sticker', 'video'])) {
            return $this->error('media type is not supported');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $content['to'],
            "context" => [
                "message_id" => $content['message_id']
            ],
            'type' => $content['type'],
            $content['type'] => [
                'id' => $content['media_id']
            ]
        ];

        $response = $this->client->post($data);

        return $this->success($response);
    }
}