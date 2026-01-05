<?php

declare(strict_types=1);

namespace Courier;

enum WebhookMethod: string
{
    case POST = 'POST';

    case PUT = 'PUT';
}
