<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplateResponse;

/**
 * The template state. Always uppercase.
 */
enum State: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
