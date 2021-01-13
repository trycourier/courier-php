<?php

namespace Courier\Tests;

/**
 * @covers Courier\Courier
 */
class NotificationTest extends TestCase
{
    public function test_send_notification()
    {
        $response = $this->getCourierClient()->sendNotification("event", "recipient");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send", $response->path);
    }

    public function test_send_idempotent_notification()
    {
        $response = $this->getCourierClient()->sendNotification("event", "recipient", NULL, [], [], [], [], "idempotent");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send", $response->path);
    }

    public function test_get_messages()
    {
        $response = $this->getCourierClient()->getMessages();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/messages", $response->path);
    }

    public function test_get_message()
    {
        $response = $this->getCourierClient()->getMessage("message001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/messages/message001", $response->path);
    }

    public function test_get_message_history()
    {
        $response = $this->getCourierClient()->getMessageHistory("message001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/messages/message001/history", $response->path);
    }

}
