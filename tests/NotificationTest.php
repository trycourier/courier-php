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

    public function test_send_notification_to_list()
    {
        $response = $this->getCourierClient()->sendNotificationToList("event", "myList");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send/list", $response->path);
    }

    public function test_send_idempotent_notification_to_list()
    {
        $response = $this->getCourierClient()->sendNotificationToList("event", "myList", NULL, NULL, [], [], "idempotent");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send/list", $response->path);
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

    public function test_get_lists()
    {
        $response = $this->getCourierClient()->getLists();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/lists", $response->path);
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

    public function test_subscribe_multiple_recipients_to_list()
    {
        $recipient1 = (object) ['recipientId' => 'recipient001'];
        $recipient2 = (object) ['recipientId' => 'recipient002'];

        $recipients = array($recipient1, $recipient2);

        $response = $this->getCourierClient()->subscribeMultipleRecipientsToList("list001", $recipients);

        $this->assertEquals("PUT", $response->method);
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

    public function test_get_brands()
    {
        $response = $this->getCourierClient()->getBrands();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/brands", $response->path);
    }

    public function test_create_brand()
    {
        $settings = (object) [];

        $response = $this->getCourierClient()->createBrand(NULL, "myBrand", $settings);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/brands", $response->path);
    }

    public function test_create_idempotent_brand()
    {
        $settings = (object) [];

        $response = $this->getCourierClient()->createBrand(NULL, "myBrand", $settings, NULL, "idempotent");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/brands", $response->path);
    }

    public function test_get_brand()
    {
        $response = $this->getCourierClient()->getBrand("brand001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/brands/brand001", $response->path);
    }

    public function test_replace_brand()
    {
        $settings = (object) [];

        $response = $this->getCourierClient()->replaceBrand("brand001", "myBrand", $settings);

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/brands/brand001", $response->path);
    }

    public function test_delete_brand()
    {
        $response = $this->getCourierClient()->deleteBrand("brand001");

        $this->assertEquals("DELETE", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/brands/brand001", $response->path);
    }
}
