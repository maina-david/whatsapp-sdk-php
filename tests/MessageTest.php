<?php

use PHPUnit\Framework\TestCase;
use MainaDavid\WhatsAppSDK\Message;

class MessageTest extends TestCase
{
    protected $message;

    protected function setUp(): void
    {
        $client = $this->createMock(\GuzzleHttp\Client::class);
        $this->message = new Message($client);
    }

    /**
     * The function tests the sendTextMessage method of a PHP class by mocking a response and asserting
     * that the status returned is "success".
     */
    public function testSendTextMessage()
    {
        $options = [
            'to' => '123456789',
            'message' => 'Hello, World!'
        ];

        $response = $this->createMock(\Psr\Http\Message\ResponseInterface::class);
        $response->method('getBody')->willReturn('{"status": "success"}');

        $client = $this->message->getClient();
        $client->method('post')->willReturn($response);

        $result = $this->message->sendTextMessage($options);

        $this->assertEquals('success', $result['status']);
    }

    /**
     * The function tests the sending of a media message with a specified URL and caption using a mocked
     * HTTP response.
     */
    public function testSendMediaMessageByURL()
    {
        $options = [
            'to' => '123456789',
            'type' => 'image',
            'url' => 'https://example.com/image.jpg',
            'caption' => 'Check out this image!'
        ];

        $response = $this->createMock(\Psr\Http\Message\ResponseInterface::class);
        $response->method('getBody')->willReturn('{"status": "success"}');

        $client = $this->message->getClient();
        $client->method('post')->willReturn($response);

        $result = $this->message->sendMediaMessageByURL($options);

        $this->assertEquals('success', $result['status']);
    }

    /**
     * The function tests the markMessageAsRead method of a PHP class by mocking a response and asserting
     * that the status returned is "success".
     */
    public function testMarkMessageAsRead()
    {
        $options = [
            'message_id' => '123456789'
        ];

        $response = $this->createMock(\Psr\Http\Message\ResponseInterface::class);
        $response->method('getBody')->willReturn('{"status": "success"}');

        $client = $this->message->getClient();
        $client->method('post')->willReturn($response);

        $result = $this->message->markMessageAsRead($options);

        $this->assertEquals('success', $result['status']);
    }
}
