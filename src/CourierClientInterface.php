<?php

namespace Courier;

use Psr\Http\Client\ClientInterface;

interface CourierClientInterface
{
    public function setHttpClient(ClientInterface $clientInterface): void;
    public function sendNotification(string $event, string $recipient, string $brand = NULL, object $profile = NULL, object $data = NULL, object $preferences = NULL, object $override = NULL, string $idempotency_key = NULL): object;
    public function sendNotificationToList(string $event, string $list = NULL, string $pattern = NULL, string $brand = NULL, object $data = NULL, object $override = NULL, string $idempotency_key = NULL): object;
    public function getMessages(string $cursor = NULL, string $event = NULL, string $list = NULL, string $message_id = NULL, string $notification = NULL, string $recipient = NULL): object;
    public function getMessage(string $message_id): object;
    public function getMessageHistory(string $message_id, string $type = NULL): object;
    public function getLists(string $cursor = NULL, string $pattern = NULL): object;
    public function getList(string $list_id): object;
    public function putList(string $list_id, string $name): object;
    public function deleteList(string $list_id): object;
    public function restoreList(string $list_id): object;
    public function getListSubscriptions(string $list_id, string $cursor = NULL): object;
    public function subscribeMultipleRecipientsToList(string $list_id, array $recipients): object;
    public function subscribeRecipientToList(string $list_id, string $recipient_id): object;
    public function deleteListSubscription(string $list_id, string $recipient_id): object;
    public function getBrands(string $cursor = NULL): object;
    public function createBrand(string $id = NULL, string $name, object $settings, object $snippets = NULL, string $idempotency_key = NULL): object;
    public function getBrand(string $brand_id): object;
    public function replaceBrand(string $brand_id, string $name, object $settings, object $snippets = NULL): object;
    public function deleteBrand(string $brand_id): object;
    public function getEvents(): object;
    public function getEvent(string $event_id): object;
    public function putEvent(string $event_id, string $id, string $type): object;
    public function getProfile(string $recipient_id): object;
    public function upsertProfile(string $recipient_id, object $profile = NULL): object;
    public function patchProfile(string $recipient_id, array $patch): object;
    public function replaceProfile(string $recipient_id, object $profile = NULL): object;
    public function getProfileLists(string $recipient_id, string $cursor = NULL): object;
    public function getPreferences(string $recipient_id, string $preferred_channel): object;
    public function updatePreferences(string $recipient_id, string $preferred_channel): object;
    public function listNotifications(string $cursor = NULL): object;
    public function getNotificationContent(string $id): object;
    public function getNotificationDraftContent(string $id): object;
    public function postNotificationVariations(string $id, array $blocks, array $channels = NULL): object;
    public function postNotificationDraftVariations(string $id, array $blocks, array $channels = NULL): object;
    public function getNotificationSubmissionChecks(string $id, string $submissionId): object;
    public function putNotificationSubmissionChecks(string $id, string $submissionId, array $checks): object;
    public function deleteNotificationSubmission(string $id, string $submissionId): object;
    public function invokeAutomation(object $automation, string $brand = NULL, string $template = NULL, string $recipient = NULL, object $data = NULL, object $profile = NULL): object;
    public function invokeAutomationFromTemplate(string $templateId, string $brand = NULL,  object $data = NULL, object $profile = NULL, string $recipient = NULL, string $template = NULL): object;
    public function getAutomationRun(string $runId): object;
}
