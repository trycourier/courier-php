<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep\Retain;

/**
 * Keep N number of notifications based on the type. First/Last N based on notification received.
 * highest/lowest based on a scoring key providing in the data accessed by sort_key.
 */
enum Type: string
{
    case FIRST = 'first';

    case LAST = 'last';

    case HIGHEST = 'highest';

    case LOWEST = 'lowest';
}
