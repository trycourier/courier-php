<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\BulkPreferenceTopic;

/**
 * The applied subscription status. Echoes the requested value, so it is always OPTED_IN or OPTED_OUT.
 */
enum Status: string
{
    case OPTED_IN = 'OPTED_IN';

    case OPTED_OUT = 'OPTED_OUT';
}
