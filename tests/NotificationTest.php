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

}
