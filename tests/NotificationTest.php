<?php

namespace Courier\Tests;

use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;

/**
 * @covers Courier\CourierClient
 */
class NotificationTest extends TestCase
{
    protected function setUp(): void
    {
        HttpClientDiscovery::prependStrategy(MockClientStrategy::class);
    }

    public function test_send_notification()
    {
        $response = $this->getCourierClient()->sendNotification("event", "recipient");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send", $response->path);
    }

    public function test_send_idempotent_notification()
    {
        $response = $this->getCourierClient()->sendNotification("event", "recipient", NULL, NULL, NULL, NULL, NULL, "idempotent");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send", $response->path);
    }

    public function test_send_enhanced_notification()
    {
        $message = (object) [];
        $response = $this->getCourierClient()->sendEnhancedNotification($message, NULL);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/send", $response->path);
    }

    public function test_send_enhanced_idempotent_notification()
    {
        $message = (object) [];
        $response = $this->getCourierClient()->sendEnhancedNotification($message, "idempotent");

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
        $response = $this->getCourierClient()->sendNotificationToList("event", "myList", NULL, NULL, NULL, NULL, "idempotent");

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

    public function test_get_events()
    {
        $response = $this->getCourierClient()->getEvents();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/events", $response->path);
    }

    public function test_get_event()
    {
        $response = $this->getCourierClient()->getEvent("event001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/events/event001", $response->path);
    }

    public function test_put_event()
    {
        $response = $this->getCourierClient()->putEvent("event001", "notification001", "notification");

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/events/event001", $response->path);
    }

    public function test_get_profile()
    {
        $response = $this->getCourierClient()->getProfile("recipient001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/profiles/recipient001", $response->path);
    }

    public function test_upsert_profile()
    {
        $response = $this->getCourierClient()->upsertProfile("recipient001", NULL);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/profiles/recipient001", $response->path);
    }

    public function test_patch_profile()
    {
        $response = $this->getCourierClient()->patchProfile("recipient001", []);

        $this->assertEquals("PATCH", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/profiles/recipient001", $response->path);
    }

    public function test_replace_profile()
    {
        $response = $this->getCourierClient()->replaceProfile("recipient001", NULL);

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/profiles/recipient001", $response->path);
    }

    public function test_get_profile_lists()
    {
        $response = $this->getCourierClient()->getProfileLists("recipient001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/profiles/recipient001/lists", $response->path);
    }

    public function test_list_notifications()
    {
        $response = $this->getCourierClient()->listNotifications();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications", $response->path);
    }

    public function test_get_notification_content()
    {
        $response = $this->getCourierClient()->getNotificationContent("notification001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/content", $response->path);
    }


    public function test_get_notification_draft_content()
    {
        $response = $this->getCourierClient()->getNotificationDraftContent("notification001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/draft/content", $response->path);
    }


    public function test_post_notification_variations()
    {
        $block1 = (object) [];
        $blocks = array($block1);

        $channel1 = (object) [];
        $channels = array($channel1);

        $response = $this->getCourierClient()->postNotificationVariations("notification001", $blocks, $channels);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/variations", $response->path);
    }

    public function test_post_notification_draft_variations()
    {
        $block1 = (object) [];
        $blocks = array($block1);

        $channel1 = (object) [];
        $channels = array($channel1);

        $response = $this->getCourierClient()->postNotificationDraftVariations("notification001", $blocks, $channels);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/draft/variations", $response->path);
    }

    public function test_get_notification_submission_checks()
    {
        $response = $this->getCourierClient()->getNotificationSubmissionChecks("notification001", "submission001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/submission001/checks", $response->path);
    }

    public function test_put_notification_submission_checks()
    {
        $check1 = (object) ['id' => 'check1', 'status' => 'RESOLVED', 'type' => 'custom'];
        $checks = array($check1);

        $response = $this->getCourierClient()->putNotificationSubmissionChecks("notification001", "submission001", $checks);

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/submission001/checks", $response->path);
    }

    public function test_cancel_notification_submission()
    {
        $response = $this->getCourierClient()->deleteNotificationSubmission("notification001", "submission001");

        $this->assertEquals("DELETE", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/notifications/notification001/submission001/checks", $response->path);
    }

    public function test_invoke_automation()
    {
        $automation = (object) [];
        $response = $this->getCourierClient()->invokeAutomation($automation);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/automations/invoke", $response->path);
    }

    public function test_invoke_automation_from_template()
    {
        $response = $this->getCourierClient()->invokeAutomationFromTemplate("automation001");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/automations/automation001/invoke", $response->path);
    }

    public function test_get_automation_run()
    {
        $response = $this->getCourierClient()->getAutomationRun("run001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/automations/runs/run001", $response->path);
    }

    public function test_create_bulk_job()
    {
        $message = (object) [];
        $response = $this->getCourierClient()->createBulkJob($message);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/bulk", $response->path);
    }

    public function test_ingest_bulk_job()
    {
        $user1 = (object) ['foo' => 'bar'];
        $users = array($user1);
        $response = $this->getCourierClient()->ingestBulkJob("job001", $users);

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/bulk/job001", $response->path);
    }

    public function test_run_bulk_job()
    {
        $response = $this->getCourierClient()->runBulkJob("job001");

        $this->assertEquals("POST", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/bulk/job001/run", $response->path);
    }

    public function test_get_bulk_job()
    {
        $response = $this->getCourierClient()->getBulkJob("job001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/bulk/job001", $response->path);
    }

    public function test_get_bulk_job_users()
    {
        $response = $this->getCourierClient()->getBulkJobUsers("job001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/bulk/job001/users", $response->path);
    }

    public function test_put_audience() {
        $audience = (object) [];
        $response = $this->getCourierClient()->putAudience("audience001", $audience);

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/audiences/audience001", $response->path);
    }

    public function test_get_audience() {
        $response = $this->getCourierClient()->getAudience("audience001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/audiences/audience001", $response->path);
    }

    public function test_get_audience_members() {
        $response = $this->getCourierClient()->getAudienceMembers("audience001");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/audiences/audience001/members", $response->path);
    }

    public function test_get_audiences() {
        $response = $this->getCourierClient()->getAudiences();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/audiences", $response->path);
    }

    public function test_put_user_tokens() {
        $tokens = array();
        $response = $this->getCourierClient()->putUserTokens("me", $tokens);

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/users/me/tokens", $response->path);
    }

    public function test_put_user_token() {
        $token = array("token" => "my_token");
        $response = $this->getCourierClient()->putUserToken("me", $token);

        $this->assertEquals("PUT", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/users/me/tokens/my_token", $response->path);
    }

    public function test_patch_user_token() {
        $patch = array(array("token" => "my_token"));
        $response = $this->getCourierClient()->patchUserToken("me", "my_token", $patch);

        $this->assertEquals("PATCH", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/users/me/tokens/my_token", $response->path);
    }

    public function test_get_user_token() {
        $response = $this->getCourierClient()->getUserToken("me", "my_token");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/users/me/tokens/my_token", $response->path);
    }

    public function test_get_user_tokens() {
        $response = $this->getCourierClient()->getUserTokens("me");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/users/me/tokens", $response->path);
    }

    public function test_get_audit_event() {
        $response = $this->getCourierClient()->getAuditEvent("my-event");

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/audit-events/my-event", $response->path);
    }

    public function test_list_audit_events() {
        $response = $this->getCourierClient()->listAuditEvents();

        $this->assertEquals("GET", $response->method);
        $this->assertEquals("application/json", $response->content);
        $this->assertEquals("/audit-events", $response->path);
    }
}
