<?php

declare(strict_types=1);

namespace Courier\Journeys\Journey;

/**
 * The version of the journey (published or draft).
 */
enum Version: string
{
    case PUBLISHED = 'published';

    case DRAFT = 'draft';
}
