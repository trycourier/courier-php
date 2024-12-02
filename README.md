# Courier PHP SDK

[![fern shield](https://img.shields.io/badge/%F0%9F%8C%BF-SDK%20generated%20by%20Fern-brightgreen)](https://github.com/fern-api/fern)
[![php shield](https://img.shields.io/badge/php-packagist-pink)](https://packagist.org/packages/trycourier/courier)

The Courier PHP library provides convenient access to the Courier API from PHP.

## Requirements

Use of the Courier PHP SDK requires:
* PHP ^8.1

## Installation

Use Composer to configure and install the Courier PHP SDK:

```shell
composer require trycourier/courier
```

## Usage

```php
use Courier\CourierClient;
use Courier\Requests\SendMessageRequest;
use Courier\Send\Types\ContentMessage;
use Courier\Send\Types\ElementalContentSugar;
use Courier\Send\Types\UserRecipient;

$courier = new CourierClient();
$response = $courier->send(
    request: new SendMessageRequest([
        'message' => new ContentMessage([
            'to' => [
                new UserRecipient([
                    'email' => 'marty_mcfly@email.com',
                    'data' => [
                        'name' => 'Marty',
                    ],
                ]),
            ],
            'content' => new ElementalContentSugar([
                'title' => 'Back to the Future',
                'body' => 'Oh my {{name}}, we need 1.21 Gigawatts!',
            ]),
        ]),
    ])
);
```

## Instantiation

To get started with the Courier SDK, instantiate the `CourierClient` class as follows:

```php
use Courier\CourierClient;

$courier = new CourierClient("COURIER_AUTH_TOKEN");
```

Alternatively, you can omit the token when constructing the client. 
In this case, the SDK will automatically read the token from the
`COURIER_AUTH_TOKEN` environment variable:

```php
use Courier\CourierClient;

$courier = new CourierClient(); // Token is read from the COURIER_AUTH_TOKEN environment variable
```

### Environment and Custom URLs

This SDK allows you to configure different environments or custom URLs for API requests. 
You can either use the predefined environments or specify your own custom URL.

#### Environments

```php
use Courier\CourierClient;
use Courier\Environments;

$courier = new CourierClient(options: [
    'baseUrl' => Environments::Production->value // Used by default
]);
```

#### Custom URL

```php
use Courier\CourierClient;

$courier = new CourierClient(options: [
    'baseUrl' => 'https://custom-staging.com'
]);
```

## Enums

This SDK leverages PHP 8.1's first-class enums to improve type safety and usability. In order to maintain forward
compatibility with the API—where new enum values may be introduced in the future—we define enum properties as `string` 
and use `value-of` annotations to specify the corresponding enum type.

### Example Usage
```php
use Courier\Messages\Types\MessageDetails;
use Courier\Messages\Types\MessageStatus;

$messageDetails = new MessageDetails([
    'status' => MessageStatus::Delivered->value,
]);
```

### PHPDoc Annotations
```php
/**
 * @var value-of<MessageStatus> $status The current status of the message.
 */
```

## Exception Handling

When the API returns a non-zero status code, (`4xx` or `5xx` response), a `CourierApiException` will be thrown:
```php
use Courier\Exceptions\CourierApiException;
use Courier\Exceptions\CourierException;

try {
    $courier->lists->get(...);
} catch (CourierApiException $e) {
    echo 'Courier API Exception occurred: ' . $e->getMessage() . "\n";
    echo 'Status Code: ' . $e->getCode() . "\n";
    echo 'Response Body: ' . $e->getBody() . "\n";
    // Optionally, rethrow the exception or handle accordingly
}
```

## Advanced

### Pagination

The SDK supports pagination for endpoints that return lists of items:

```php
use Courier\Lists\Requests\GetAllListsRequest;

$items = $courier->lists->list(
    request: new GetAllListsRequest([
        'cursor' => 'abc123',
        'pageSize' => 10,
    ])
)->items;

foreach ($items as $list) {
    echo "Found list with ID: " . $list->id . "\n";
}
```

### Custom HTTP Client

This SDK is built to work with any HTTP client that implements Guzzle's `ClientInterface`. By default, if no client
is provided, the SDK will use Guzzle's default HTTP client. However, you can pass your own client that adheres to
`ClientInterface`:

```php
use GuzzleHttp\Client;
use Courier\CourierClient;

// Create a custom Guzzle client with specific configuration.
$client = new Client([
    'timeout' => 5.0,
]);

// Pass the custom client when creating an instance of the class.
$courier = new CourierClient(options: [
    'client' => $client
]);
```

## Contributing

While we value open-source contributions to this SDK, this library
is generated programmatically. Additions made directly to this library
would have to be moved over to our generation code, otherwise they would
be overwritten upon the next generated release. Feel free to open a PR as a
proof of concept, but know that we will not be able to merge it as-is.
We suggest opening an issue first to discuss with us!

On the other hand, contributions to the README are always very welcome!
