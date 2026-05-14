<?php

declare(strict_types=1);

namespace Courier\Journeys;

enum JourneyState: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
