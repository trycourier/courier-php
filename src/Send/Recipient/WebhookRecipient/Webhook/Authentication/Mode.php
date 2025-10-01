<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\WebhookRecipient\Webhook\Authentication;

/**
 * The authentication mode to use. Defaults to 'none' if not specified.
 */
enum Mode: string
{
    case NONE = 'none';

    case BASIC = 'basic';

    case BEARER = 'bearer';
}
