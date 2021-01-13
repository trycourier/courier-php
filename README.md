# Courier SDK

Courier PHP SDK supporting:
* Send API
* Messages API
* Profiles API
* Preferences API

## Official Courier API docs

For a full description of request and response payloads and properties, please see the [official Courier API docs](https://docs.courier.com/reference).

## Requirements

* PHP 7.2+
* ext-curl
* ext-json

## Installation

```bash
composer require courier/courier-php
````

## Configuration

Instantiate the Courier client class with your authorization token OR username and password. Providing just a authorization token will generate a "Bearer" authorization header, while providing a username and password will generate a "Basic" (base64-encoded) authorization header

```php
$client = new Courier("base-url", "authorization-token", "username", "password");
```

### Options

Many methods allow the passing of optional data to the Courier endoint. This data should be an associative array of key/value pairs. The exact options supported are dependent on the endpoint being called. Please refer to the official Courier documentation for more information.

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

* ```sendNotification(string $event, string $recipient, string $brand = NULL, array $profile = [], array $data = [], array $preferences = [], array $override = [], string $idempotency_key = NULL): object``` [[?]](https://docs.courier.com/reference/send-api#sendmessage)

### Messages API

* ```getMessages(string $cursor = NULL, string $event = NULL, string $list = NULL, string $message_id = NULL, string $notification = NULL, string $recipient = NULL): object``` [[?]](https://docs.courier.com/reference/messages-api#getmessages)
* ```getMessage(string $message_id): object``` [[?]](https://docs.courier.com/reference/messages-api#getmessagebyid)
* ```getMessageHistory(string $message_id, string $type = NULL): object``` [[?]](https://docs.courier.com/reference/messages-api#getmessagehistorybyid)

### Profiles API

* ```getProfile(string $recipient_id): object``` [[?]](https://docs.trycourier.com/reference#get-preferencesrecipient_id)
* ```upsertProfile(string $recipient_id, array $profile_attributes): object``` [[?]](https://docs.trycourier.com/reference#post-profilesid)
* ```replaceProfile(string $recipient_id, array $profile_attributes): object``` [[?]](https://docs.trycourier.com/reference#put-profilesid)
* ```patchProfile(string $recipient_id, array $patch): object``` [[?]](https://docs.trycourier.com/reference#patch-profilesid)

### Preferences API

* ```getPreferences(string $recipient_id, string $preferred_channel): object``` [[?]](https://docs.trycourier.com/reference#get-preferencesrecipient_id)
* ```updatePreferences(string $recipient_id, string $preferred_channel): object``` [[?]](https://docs.trycourier.com/reference#put-preferencesrecipient_id)

## Errors

All unsuccessfull (non 2xx) responses will throw a ```CourierRequestException```. The full response object is available via the ```getResponse()``` method.
