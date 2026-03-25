<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplateSummary;

enum State: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
