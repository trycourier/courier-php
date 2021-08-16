<?php

namespace Courier;

use Psr\Http\Client\ClientInterface;

interface CourierClientInterface {
    public function setHttpClient(ClientInterface $clientInterface): void;
    public function sendNotification(string $event, string $recipient, string $brand, object $profile, object $data, object $preferences, object $override, string $idempotency_key): object;
    public function sendNotificationToList(string $event, string $list, string $pattern, string $brand, object $data, object $override, string $idempotency_key): object;
    public function getMessages(string $cursor, string $event, string $list, string $message_id, string $notification, string $recipient): object;
    public function getMessage(string $message_id): object;
    public function getMessageHistory(string $message_id, string $type): object;
    public function getLists(string $cursor, string $pattern): object;
    public function getList(string $list_id): object;
    public function putList(string $list_id, string $name): object;
    public function deleteList(string $list_id): object;
    public function restoreList(string $list_id): object;
    public function getListSubscriptions(string $list_id, string $cursor): object;
    public function subscribeMultipleRecipientsToList(string $list_id, array $recipients): object;
    public function subscribeRecipientToList(string $list_id, string $recipient_id): object;
    public function deleteListSubscription(string $list_id, string $recipient_id): object;
    public function getBrands(string $cursor): object;
    public function createBrand(string $id, string $name, object $settings, object $snippets, string $idempotency_key): object;
    public function getBrand(string $brand_id): object;
    public function replaceBrand(string $brand_id, string $name, object $settings, object $snippets): object;
    public function deleteBrand(string $brand_id): object;
    public function getEvents(): object;
    public function getEvent(string $event_id): object;
    public function putEvent(string $event_id, string $id, string $type): object;
    public function getProfile(string $recipient_id): object;
    public function upsertProfile(string $recipient_id, object $profile): object;
    public function patchProfile(string $recipient_id, array $patch): object;
    public function replaceProfile(string $recipient_id, object $profile): object;
    public function getProfileLists(string $recipient_id, string $cursor): object;
    public function getPreferences(string $recipient_id, string $preferred_channel): object;
    public function updatePreferences(string $recipient_id, string $preferred_channel): object;
}
