<?php

declare(strict_types=1);

namespace Courier\Send\Preference;

enum Source: string
{
    case SUBSCRIPTION = 'subscription';

    case LIST = 'list';

    case RECIPIENT = 'recipient';
}
