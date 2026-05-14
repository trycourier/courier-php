<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyTemplateGetResponse;

enum State: string
{
    case DRAFT = 'DRAFT';

    case PUBLISHED = 'PUBLISHED';
}
