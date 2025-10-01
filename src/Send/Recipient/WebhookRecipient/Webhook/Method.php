<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\WebhookRecipient\Webhook;

/**
 * The HTTP method to use for the webhook request. Defaults to POST if not specified.
 */
enum Method: string
{
    case POST = 'POST';

    case PUT = 'PUT';
}
