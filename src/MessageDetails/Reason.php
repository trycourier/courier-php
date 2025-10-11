<?php

declare(strict_types=1);

namespace Courier\MessageDetails;

/**
 * The reason for the current status of the message.
 */
enum Reason: string
{
    case BOUNCED = 'BOUNCED';

    case FAILED = 'FAILED';

    case FILTERED = 'FILTERED';

    case NO_CHANNELS = 'NO_CHANNELS';

    case NO_PROVIDERS = 'NO_PROVIDERS';

    case OPT_IN_REQUIRED = 'OPT_IN_REQUIRED';

    case PROVIDER_ERROR = 'PROVIDER_ERROR';

    case UNPUBLISHED = 'UNPUBLISHED';

    case UNSUBSCRIBED = 'UNSUBSCRIBED';
}
