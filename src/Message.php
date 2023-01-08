<?php

namespace MainaDavid\WhatsappSdk;

class Message extends service
{
    public function __construct($client)
    {
        parent::__construct($client);
    }

    /**
     * It takes a recipient and a message, and sends it to the recipient
     * 
     * @param content an array containing the following keys: ['to'], ['message']
     * 
     * @return The response from the API.
     */
    public function send($content)
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
}