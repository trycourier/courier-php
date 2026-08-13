# Courier PHP SDK

The Courier PHP SDK provides typed access to the Courier REST API from PHP applications. Use it to send notifications, manage user profiles, check message status, issue JWT tokens for client-side SDKs, and more.

## Installation

The package is not on Packagist, so add the repository to your `composer.json` first:

```json
{
  "repositories": [
    { "type": "vcs", "url": "https://github.com/trycourier/courier-php.git" }
  ]
}
```

Then require it:

```bash
composer require trycourier/courier-php
```

Requires PHP 8.1+.

## Quick Start

```php
<?php

use Courier\Client;

$client = new Client(apiKey: getenv('COURIER_API_KEY'));

$response = $client->send->message(
  message: [
    'to' => ['userID' => 'your_user_id'],
    'template' => 'your_template_id',
    'data' => ['foo' => 'bar'],
  ],
);

var_dump($response->requestId);
```

The client reads `COURIER_API_KEY` from your environment automatically.

## Documentation

Full documentation: **[courier.com/docs/sdk-libraries/php](https://www.courier.com/docs/sdk-libraries/php/)**

- [Quickstart](https://www.courier.com/docs/getting-started/quickstart/)
- [Send API](https://www.courier.com/docs/platform/sending/send-message/)
- [API Reference](https://www.courier.com/docs/reference/get-started/)
