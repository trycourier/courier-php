<?php

namespace Digs\Courier\Tests;

/**
 * @covers Digs\Courier\Courier
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

}