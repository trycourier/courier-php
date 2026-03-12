<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyListParams;

/**
 * The version of journeys to retrieve. Accepted values are published (for published journeys) or draft (for draft journeys). Defaults to published.
 */
enum Version: string
{
    case PUBLISHED = 'published';

    case DRAFT = 'draft';
}
