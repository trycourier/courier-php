<?php

namespace Courier;

use Psr\Http\Client\ClientInterface;

interface CourierClientInterface
{
    public function setHttpClient(ClientInterface $clientInterface): void;
    public function sendNotification(string $event, string $recipient, string $brand = null, object $profile = null, object $data = null, object $preferences = null, object $override = null, string $idempotency_key = null): object;
    public function sendEnhancedNotification(object $message, string $idempotency_key = null): object;
    public function sendNotificationToList(string $event, string $list = null, string $pattern = null, string $brand = null, object $data = null, object $override = null, string $idempotency_key = null): object;
    public function getMessages(string $cursor = null, string $event = null, string $list = null, string $message_id = null, string $notification = null, string $recipient = null): object;
    public function getMessage(string $message_id): object;
    public function getMessageHistory(string $message_id, string $type = null): object;
    public function getLists(string $cursor = null, string $pattern = null): object;
    public function getList(string $list_id): object;
    public function putList(string $list_id, string $name): object;
    public function deleteList(string $list_id): object;
    public function restoreList(string $list_id): object;
    public function getListSubscriptions(string $list_id, string $cursor = null): object;
    public function subscribeMultipleRecipientsToList(string $list_id, array $recipients): object;
    public function subscribeRecipientToList(string $list_id, string $recipient_id): object;
    public function deleteListSubscription(string $list_id, string $recipient_id): object;
    public function getBrands(string $cursor = null): object;
    public function createBrand(string $id = null, string $name, object $settings, object $snippets = null, string $idempotency_key = null): object;
    public function getBrand(string $brand_id): object;
    public function replaceBrand(string $brand_id, string $name, object $settings, object $snippets = null): object;
    public function deleteBrand(string $brand_id): object;
    public function getEvents(): object;
    public function getEvent(string $event_id): object;
    public function putEvent(string $event_id, string $id, string $type): object;
    public function getProfile(string $recipient_id): object;
    public function upsertProfile(string $recipient_id, object $profile = null): object;
    public function patchProfile(string $recipient_id, array $patch): object;
    public function replaceProfile(string $recipient_id, object $profile = null): object;
    public function getProfileLists(string $recipient_id, string $cursor = null): object;
    public function getPreferences(string $recipient_id, string $preferred_channel): object;
    public function updatePreferences(string $recipient_id, string $preferred_channel): object;
    public function listNotifications(string $cursor = null): object;
    public function getNotificationContent(string $id): object;
    public function getNotificationDraftContent(string $id): object;
    public function postNotificationVariations(string $id, array $blocks, array $channels = null): object;
    public function postNotificationDraftVariations(string $id, array $blocks, array $channels = null): object;
    public function getNotificationSubmissionChecks(string $id, string $submission_id): object;
    public function putNotificationSubmissionChecks(string $id, string $submission_id, array $checks): object;
    public function deleteNotificationSubmission(string $id, string $submission_id): object;
    public function invokeAutomation(object $automation, string $brand = null, string $template = null, string $recipient = null, object $data = null, object $profile = null): object;
    public function invokeAutomationFromTemplate(string $template_id, string $brand = null,  object $data = null, object $profile = null, string $recipient = null, string $template = null): object;
    public function getAutomationRun(string $run_id): object;
    public function createBulkJob(object $message): object;
    public function ingestBulkJob(string $job_id, array $users): object;
    public function runBulkJob(string $job_id): object;
    public function getBulkJob(string $job_id): object;
    public function getBulkJobUsers(string $job_id): object;
    public function putAudience(string $audienceId, object $audience): object;
    public function getAudience(string $audienceId): object;
    public function getAudienceMembers(string $audienceId): object;
    public function getAudiences(): object;
    public function putUserTokens(string $user_id, array $tokens): object;
    public function putUserToken(string $user_id, array $token): object;
    public function patchUserToken(string $user_id, string $token, array $patch): object;
    public function getUserToken(string $user_id, string $token): object;
    public function getUserTokens(string $user_id): object;
    public function getAuditEvent(string $audit_event_id): object;
    public function listAuditEvents(string $cursor = null): object;
}
