<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplateUpdateRequest;

/**
 * Template state after update. Case-insensitive input, normalized to uppercase in the response. Defaults to "DRAFT".
 */
enum State: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
