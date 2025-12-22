<?php

declare(strict_types=1);

namespace Courier;

enum WebhookProfileType: string
{
    case LIMITED = 'limited';

    case EXPANDED = 'expanded';
}
