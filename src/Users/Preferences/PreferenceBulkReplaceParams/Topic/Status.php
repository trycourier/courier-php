<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\PreferenceBulkReplaceParams\Topic;

/**
 * The subscription status to apply for this topic.
 */
enum Status: string
{
    case OPTED_IN = 'OPTED_IN';

    case OPTED_OUT = 'OPTED_OUT';
}
