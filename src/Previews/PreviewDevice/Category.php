<?php

declare(strict_types=1);

namespace Courier\Previews\PreviewDevice;

/**
 * Where the app runs.
 */
enum Category: string
{
    case WEBMAIL = 'webmail';

    case MOBILE = 'mobile';

    case DESKTOP = 'desktop';
}
