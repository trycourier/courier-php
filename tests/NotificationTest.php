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

    public function test_get_list()
    {
        $response = $this->getCourierClient()->getList("list001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001", $response->path);
    }

    public function test_put_list()
    {
        $response = $this->getCourierClient()->putList("list001", "myList");

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001", $response->path);
    }

    public function test_delete_list()
    {
        $response = $this->getCourierClient()->deleteList("list001");

        $this->assertEquals("DELETE", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001", $response->path);
    }

    public function test_restore_list()
    {
        $response = $this->getCourierClient()->restoreList("list001");

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001/restore", $response->path);
    }

    public function test_get_list_subscriptions()
    {
        $response = $this->getCourierClient()->getListSubscriptions("list001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001/subscriptions", $response->path);
    }

    public function test_subscribe_recipient_to_list()
    {
        $response = $this->getCourierClient()->subscribeRecipientToList("list001", "recipient001");

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001/subscriptions/recipient001", $response->path);
    }

    public function test_delete_list_subscription()
    {
        $response = $this->getCourierClient()->deleteListSubscription("list001", "recipient001");

        $this->assertEquals("DELETE", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists/list001/subscriptions/recipient001", $response->path);
    }
}
