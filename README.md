<!-- AUTO-GENERATED-OVERVIEW:START — Do not edit this section. It is synced from mintlify-docs. -->
# Courier PHP SDK

> **Beta**: The PHP SDK is in beta. APIs may change between releases. [Share feedback or report issues on GitHub.](https://github.com/trycourier/courier-php/issues/new)

The Courier PHP SDK provides typed access to the Courier REST API from any PHP 8.1+ application. It uses named parameters for optional arguments and returns strongly typed response objects.

## Installation

Add to your `composer.json`:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:trycourier/courier-php.git"
    }
  ],
  "require": {
    "trycourier/courier": "dev-main"
  }
}
```

Then run `composer install`.

## Quick Start

```php
<?php

use CourierClient;

$client = new Client(apiKey: getenv('COURIER_API_KEY'));

$response = $client->send->message(
  message: [
    'to' => ['email' => 'you@example.com'],
    'content' => [
      'title' => 'Hello from Courier!',
      'body' => 'Your first notification, sent with the PHP SDK.',
    ],
  ],
);

var_dump($response->requestId);
```

The client reads your API key from the constructor argument. Set `COURIER_API_KEY` in your environment and pass it with `getenv('COURIER_API_KEY')`.

## Documentation

Full documentation: **[courier.com/docs/sdk-libraries/php](https://www.courier.com/docs/sdk-libraries/php/)**

- [Quickstart](https://www.courier.com/docs/getting-started/quickstart/)
- [Send API](https://www.courier.com/docs/platform/sending/send-message/)
- [API Reference](https://www.courier.com/docs/reference/get-started/)
<!-- AUTO-GENERATED-OVERVIEW:END -->
