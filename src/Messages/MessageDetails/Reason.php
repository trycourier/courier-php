<?php

declare(strict_types=1);

namespace Courier\Messages\MessageDetails;

/**
 * The reason for the current status of the message.
 */
enum Reason: string
{
    case FILTERED = 'FILTERED';

    case NO_CHANNELS = 'NO_CHANNELS';

    case NO_PROVIDERS = 'NO_PROVIDERS';

    case PROVIDER_ERROR = 'PROVIDER_ERROR';

    case UNPUBLISHED = 'UNPUBLISHED';

    case UNSUBSCRIBED = 'UNSUBSCRIBED';
}
