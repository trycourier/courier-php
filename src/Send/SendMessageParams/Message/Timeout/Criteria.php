<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Timeout;

enum Criteria: string
{
    case NO_ESCALATION = 'no-escalation';

    case DELIVERED = 'delivered';

    case VIEWED = 'viewed';

    case ENGAGED = 'engaged';
}
