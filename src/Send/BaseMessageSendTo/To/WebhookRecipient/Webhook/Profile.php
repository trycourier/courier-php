<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\WebhookRecipient\Webhook;

/**
 * Specifies what profile information is included in the request payload. Defaults to 'limited' if not specified.
 */
enum Profile: string
{
    case LIMITED = 'limited';

    case EXPANDED = 'expanded';
}
