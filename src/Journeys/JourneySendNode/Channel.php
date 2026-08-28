<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode;

/**
 * The channel this node sends through. Optional — when omitted, the field is absent from the node, including on `GET`; nodes created before this field existed have it unset. Setting it makes the node's channel explicit to any client reading the journey.
 */
enum Channel: string
{
    case EMAIL = 'email';

    case SMS = 'sms';

    case PUSH = 'push';

    case INBOX = 'inbox';

    case SLACK = 'slack';

    case MSTEAMS = 'msteams';
}
