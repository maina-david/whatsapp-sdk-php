<?php

use GuzzleHttp\Client;
use MainaDavid\WhatsAppSDK\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /**
     * This is a unit test for the sendTextMessage method of a Message class that uses a mock client to
     * test if the method sends a text message with the correct parameters.
     */
    public function testSendTextMessage()
    {
        // Create a mock of the client class
        $clientMock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Set up the expected method call and response for the mock
        $clientMock->expects($this->once())
            ->method('post')
            ->with(
                $this->equalTo('messages'),
                $this->equalTo(['form_params' => [
                    'messaging_product' => 'whatsapp',
                    'recipient_type' => 'individual',
                    'to' => '1234567890',
                    'type' => 'text',
                    'text' => [
                        'preview_url' => false,
                        'body' => 'Hello, world!'
                    ]
                ]])
            )
            ->willReturn('Success!');

        // Create an instance of the Message class and inject the mock client
        $message = new Message($clientMock);

        // Call the sendTextMessage method with sample options
        $options = [
            'to' => '1234567890',
            'message' => 'Hello, world!'
        ];
        $result = $message->sendTextMessage($options);

        // Assert that the method returns the expected success response
        $this->assertEquals('Success!', $result);
    }
}
