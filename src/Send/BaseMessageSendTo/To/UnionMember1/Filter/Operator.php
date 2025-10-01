<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\UnionMember1\Filter;

/**
 * Send to users only if they are member of the account.
 */
enum Operator: string
{
    case MEMBER_OF = 'MEMBER_OF';
}
