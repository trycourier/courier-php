<?php

declare(strict_types=1);

namespace Courier\Journeys;

/**
 * Lifecycle state of a journey.
 */
enum JourneyState: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
