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
     * @param content an array containing the following keys:['to'], ['message']
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
}