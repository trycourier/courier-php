<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneyTemplateReplaceRequest\Notification\Content;

enum Scope: string
{
    case DEFAULT = 'default';

    case STRICT = 'strict';
}
