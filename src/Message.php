<?php

namespace MainaDavid\WhatsappSdk;

class Message extends Service
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
    public function sendTextMessage($options)
    {
        if (empty($options['to']) || empty($options['message'])) {
            return $this->error('recipient and message must be defined');
        }

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $options['to'],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => $options['message']
            ]
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * It sends a text message to a recipient
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendReplytoTextMessage($options)
    {
        if (empty($options['to']) || empty($options['message_id']) || empty($options['message'])) {
            return $this->error('recipient, message ID and message must be defined');
        }

        $data = [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $options['to'],
            "context" => [
                "message_id" => $options['message_id']
            ],
            "type" => "text",
            "text" => [
                "preview_url" => false,
                "body" => $options['message']
            ]
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * It sends a media message to a recipient using a URL
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendMediaMessageByURL($options)
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
                'link' => $options['url'],
                'caption' => $options['caption'] ? $options['caption'] : ''
            ]
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * Send a media message to a recipient by media ID
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function sendMediaMessageByID($options)
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

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * Send a reply to a media message by URL
     * 
     * @param content This is the array of parameters that you want to send to the API.
     * 
     * @return The response from the API.
     */
    public function sendReplytoMediaMessageByURL($options)
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
            "context" => [
                "message_id" => $options['message_id']
            ],
            'type' => $options['type'],
            $options['type'] => [
                'link' => $options['url']
            ]
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * Send a reply to a media message by ID
     * 
     * @param content This is the array of parameters that you want to send to the API.
     * 
     * @return The response from the API.
     */
    public function sendReplytoMediaMessageByID($options)
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
            "context" => [
                "message_id" => $options['message_id']
            ],
            'type' => $options['type'],
            $options['type'] => [
                'id' => $options['media_id']
            ]
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * Send a location message to a recipient
     * 
     * @param content an array containing the following keys:
     * 
     * @return The response from the API.
     */
    public function sendLocationMessage($options)
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

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * Send a location message to a recipient
     * 
     * @param content an array containing the following keys:
     * 
     * @return The response from the API.
     */
    public function sendReplytoLocationMessage($options)
    {
        if (empty($options['to']) || empty($options['latitude']) || empty($options['longitude']) || empty($options['name']) || empty($options['address']) || empty($options['message_id'])) {
            return $this->error('recipient, latitude, longitude, name, address and message ID must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'recipient_type' => 'individual',
            'to' => $options['to'],
            "context" => [
                "message_id" => $options['message_id']
            ],
            'type' => 'location',
            'location' => [
                'latitude' => $options['latitude'],
                'longitude' => $options['longitude'],
                'name' => $options['name'],
                'address' => $options['address']
            ]
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }

    /**
     * It marks a message as read
     * 
     * @param content This is the content of the message.
     * 
     * @return The response from the API.
     */
    public function markMessageAsRead($options)
    {
        if (empty($options['message_id'])) {
            return $this->error('message ID must be defined');
        }

        $data = [
            'messaging_product' => 'whatsapp',
            'status' => 'read',
            "message_id" => $options['message_id']
        ];

        $response = $this->client->send($data);

        return $this->success($response);
    }
}