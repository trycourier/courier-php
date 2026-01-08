<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationListParams;

/**
 * The version of templates to retrieve. Accepted values are published (for published templates) or draft (for draft templates). Defaults to published.
 */
enum Version: string
{
    case PUBLISHED = 'published';

    case DRAFT = 'draft';
}
