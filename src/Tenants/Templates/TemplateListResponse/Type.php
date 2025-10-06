<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates\TemplateListResponse;

/**
 * Always set to `list`. Represents the type of this object.
 */
enum Type: string
{
    case LIST = 'list';
}
