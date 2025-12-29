<?php

declare(strict_types=1);

namespace Courier;

enum WebhookAuthMode: string
{
    case NONE = 'none';

    case BASIC = 'basic';

    case BEARER = 'bearer';
}
