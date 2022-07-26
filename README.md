# Courier SDK

Courier PHP SDK supporting:

- Send API
- Messages API
- Profiles API
- Preferences API
- Events API
- Brands API
- Lists API
- Notifications API
- Automations API
- Bulk API
- Audiences API
- Token Management API
- Audit Events API

## Official Courier API docs

For a full description of request and response payloads and properties, please see the [official Courier API docs](https://docs.courier.com/reference).

## Requirements

- PHP 7.2+
- ext-json

## Installation

This library uses [HTTPlug](https://github.com/php-http/httplug) as HTTP client. HTTPlug is an abstraction that allows
this library to support different HTTP Clients. Therefore, you need to provide it with an client and/or adapter for the HTTP
library you prefer. You can find all the available adapters [in Packagist](https://packagist.org/providers/php-http/client-implementation).
This documentation assumes you use the Guzzle Client, but you can replace it with any client that you prefer.

The recommended way to install courier-php is through Composer:

```bash
composer require trycourier/courier guzzlehttp/guzzle
```

## Configuration

Instantiate the Courier client class with your authorization token OR username and password. Providing just an authorization token will generate a "Bearer" authorization header, while providing a username and password will generate a "Basic" (base64-encoded) authorization header

```php
$client = new CourierClient("base-url", "authorization-token", "username", "password");
```

### Options

Many methods allow the passing of optional data to the Courier endpoints. This data should be an associative array of key/value pairs. The exact options supported are dependent on the endpoint being called. Please refer to the official Courier documentation for more information.

```php
$profile = [
	"firstname" => "Johnny",
	"lastname" => "Appleseed",
	"email" => "courier.pigeon@mail.com"
];
```

## Methods

For a full description of request and response payloads and properties, please see the [official Courier API docs](https://docs.courier.com/reference).

### Send API

- `sendNotification(string $event, string $recipient, string $brand = NULL, object $profile = NULL, object $data = NULL, object $preferences = NULL, object $override = NULL, string $idempotency_key = NULL): object` [(Send API)](https://www.courier.com/docs/reference/send/message/)
- `sendEnhancedNotification(object $message, string $idempotency_key = NULL): object` [(Send API)](https://www.courier.com/docs/reference/send/message/)
- `sendNotificationToList(string $event, string $list = NULL, string $pattern = NULL, string $brand = NULL, object $data = NULL, object $override = NULL, string $idempotency_key = NULL): object` [(Send list API)](https://www.courier.com/docs/reference/send/list/)

### Messages API

- `getMessages(string $cursor = NULL, string $event = NULL, string $list = NULL, string $message_id = NULL, string $notification = NULL, string $recipient = NULL): object` [[?]](https://docs.courier.com/reference/messages-api#getmessages)
- `getMessage(string $message_id): object` [[?]](https://docs.courier.com/reference/messages-api#getmessagebyid)
- `getMessageHistory(string $message_id, string $type = NULL): object` [[?]](https://docs.courier.com/reference/messages-api#getmessagehistorybyid)

### Lists API

- `getLists(string $cursor = NULL, string $pattern = NULL): object` [[?]](https://docs.courier.com/reference/lists-api#getlists)
- `getList(string $list_id): object` [[?]](https://docs.courier.com/reference/lists-api#getlist)
- `putList(string $list_id, string $name): object` [[?]](https://docs.courier.com/reference/lists-api#putlist)
- `deleteList(string $list_id): object` [[?]](https://docs.courier.com/reference/lists-api#deletelist)
- `restoreList(string $list_id): object` [[?]](https://docs.courier.com/reference/lists-api#putlistrestore)
- `getListSubscriptions(string $list_id, string $cursor = NULL): object` [[?]](https://docs.courier.com/reference/lists-api#getlistsubscriptions)
- `subscribeMultipleRecipientsToList(string $list_id, array $recipients): object` [[?]](https://docs.courier.com/reference/lists-api#createlistsubscriptions)
- `subscribeRecipientToList(string $list_id, string $recipient_id): object` [[?]](https://docs.courier.com/reference/lists-api#putlistsubscription)
- `deleteListSubscription(string $list_id, string $recipient_id): object` [[?]](https://docs.courier.com/reference/lists-api#deletelistsubscription)

### Brands API

- `getBrands(string $cursor = NULL): object` [[?]](https://docs.courier.com/reference/brands-api#getbrands)
- `createBrand(string $id = NULL, string $name, object $settings, object $snippets = NULL, string $idempotency_key = NULL): object` [[?]](https://docs.courier.com/reference/brands-api#createbrand)
- `getBrand(string $brand_id): object` [[?]](https://docs.courier.com/reference/brands-api#getbrand)
- `replaceBrand(string $brand_id, string $name, object $settings, object $snippets = NULL): object` [[?]](https://docs.courier.com/reference/brands-api#replacebrand)
- `deleteBrand(string $brand_id): object` [[?]](https://docs.courier.com/reference/brands-api#deletebrand)

### Events API

- `getEvents(): object` [[?]](https://docs.courier.com/reference/events-api#getevents)
- `getEvent(string $event_id): object` [[?]](https://docs.courier.com/reference/events-api#geteventbyid)
- `putEvent(string $event_id, string $id, string $type): object` [[?]](https://docs.courier.com/reference/events-api#replaceeventbyid)

### Profiles API

- `getProfile(string $recipient_id): object` [[?]](https://docs.courier.com/reference/profiles-api#getprofilebyrecipientid)
- `upsertProfile(string $recipient_id, object $profile): object` [[?]](https://docs.courier.com/reference/profiles-api#mergeprofilebyrecipientid)
- `patchProfile(string $recipient_id, array $patch): object` [[?]](https://docs.courier.com/reference/profiles-api#patchprofilebyrecipientid)
- `replaceProfile(string $recipient_id, object $profile): object` [[?]](https://docs.courier.com/reference/profiles-api#replaceprofilebyrecipientid)
- `getProfileLists(string $recipient_id, string $cursor = NULL): object` [[?]](https://docs.courier.com/reference/profiles-api#getlistsforprofilebyrecipientid)

### Preferences API

- `getPreferences(string $recipient_id, string $preferred_channel): object` [[?]](https://docs.courier.com/reference#get-preferencesrecipient_id)
- `updatePreferences(string $recipient_id, string $preferred_channel): object` [[?]](https://docs.courier.com/reference#put-preferencesrecipient_id)

### Notifications API

- `listNotifications(string $cursor = NULL): object`
- `getNotificationContent(string $id): object`
- `getNotificationDraftContent(string $id): object`
- `postNotificationVariations(string $id, array $blocks, array $channels = NULL): object`
- `postNotificationDraftVariations(string $id, array $blocks, array $channels = NULL): object`
- `getNotificationSubmissionChecks(string $id, string $submissionId): object`
- `putNotificationSubmissionChecks(string $id, string $submissionId, array $checks): object`
- `deleteNotificationSubmission(string $id, string $submissionId): object`

### Automations API

- `invokeAutomation(object $automation, string $brand = NULL, string $template = NULL, string $recipient = NULL, object $data = NULL, object $profile = NULL): object` [[?]](https://docs.courier.com/reference/invokeautomation)
- `invokeAutomationFromTemplate(string $templateId, string $brand = NULL, object $data = NULL, object $profile = NULL, string $recipient = NULL, string $template = NULL): object` [[?]](https://docs.courier.com/reference/invokeautomationtemplate)
- `getAutomationRun(string $runId): object`

### Bulk API

- `createBulkJob(object $message): object` [(Create Bulk Job)](https://www.courier.com/docs/reference/bulk/create-job/)
- `ingestBulkJob(string $jobId, array $users): object` [(Ingest Bulk Job Users)](https://www.courier.com/docs/reference/bulk/ingest-users/)
- `runBulkJob(string $jobId): object` [(Run Bulk Job)](https://www.courier.com/docs/reference/bulk/run-job/)
- `getBulkJob(string $jobId): object` [(Get Bulk Job)](https://www.courier.com/docs/reference/bulk/get-job/)
- `getBulkJobUsers(string $jobId): object` [(Get Bulk Job Users)](https://www.courier.com/docs/reference/bulk/get-users/)

### Audiences API

- `putAudience(object $audience): object` [(Create Audience)](https://www.courier.com/docs/reference/audiences/put-audience/)
- `getAudience(string $audienceId): object` [(Get Audience)](https://www.courier.com/docs/reference/audiences/get-audience/)
- `getAudienceMembers(string $audienceId): object` [(List audience members)](https://www.courier.com/docs/reference/audiences/list-audience-members/)
- `getAudiences(): object` [(List audiences)](https://www.courier.com/docs/reference/audiences/list-audience-members/)

### Token Management API

- `putUserTokens(string $user_id, array $tokens): object` [(Put User Tokens)](https://www.courier.com/docs/reference/token-management/put-tokens/)
- `putUserToken(string $user_id, array $token): object` [(Put User Token)](https://www.courier.com/docs/reference/token-management/put-token/)
- `patchUserToken(string $user_id, string $token, array $patch): object` [(Patch User Token)](https://www.courier.com/docs/reference/token-management/patch-token/)
- `getUserToken(string $user_id, string $token): object` [(Get User Token)](https://www.courier.com/docs/reference/token-management/get-token/)
- `getUserTokens(string $user_id): object` [(Get User Tokens)](https://www.courier.com/docs/reference/token-management/get-tokens/)

### Audit Events API

- `getAuditEvent(string $audit_event_id): object` [(Get Audit Event)](https://www.courier.com/docs/reference/audit-events/by-id/)
- `listAuditEvents(string $cursor = NULL): object` [(List Audit Events)](https://www.courier.com/docs/reference/audit-events/list/)

## Errors

All unsuccessful (non 2xx) responses will throw a `CourierRequestException`. The full response object is available via the `getResponse()` method.
