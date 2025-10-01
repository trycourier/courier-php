<?php

declare(strict_types=1);

namespace Courier\Send\Recipient\AudienceRecipient\Filter;

/**
 * Send to users only if they are member of the account.
 */
enum Operator: string
{
    case MEMBER_OF = 'MEMBER_OF';
}
