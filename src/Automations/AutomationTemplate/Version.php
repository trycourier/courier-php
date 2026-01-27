<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationTemplate;

/**
 * The version of the template published or drafted.
 */
enum Version: string
{
    case PUBLISHED = 'published';

    case DRAFT = 'draft';
}
