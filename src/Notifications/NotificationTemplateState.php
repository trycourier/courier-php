<?php

declare(strict_types=1);

namespace Courier\Notifications;

/**
 * Template state. Defaults to `DRAFT`.
 */
enum NotificationTemplateState: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
