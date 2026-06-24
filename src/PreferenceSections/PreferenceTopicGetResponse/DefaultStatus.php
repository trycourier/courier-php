<?php

declare(strict_types=1);

namespace Courier\PreferenceSections\PreferenceTopicGetResponse;

/**
 * The default subscription status applied when a recipient has not set their own.
 */
enum DefaultStatus: string
{
    case OPTED_OUT = 'OPTED_OUT';

    case OPTED_IN = 'OPTED_IN';

    case REQUIRED = 'REQUIRED';
}
