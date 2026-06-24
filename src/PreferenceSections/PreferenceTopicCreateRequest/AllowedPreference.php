<?php

declare(strict_types=1);

namespace Courier\PreferenceSections\PreferenceTopicCreateRequest;

/**
 * A preference control a recipient may customize for a topic.
 */
enum AllowedPreference: string
{
    case SNOOZE = 'snooze';

    case CHANNEL_PREFERENCES = 'channel_preferences';
}
