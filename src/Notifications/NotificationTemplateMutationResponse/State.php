<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplateMutationResponse;

/**
 * The template state after the operation. Always uppercase.
 */
enum State: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
