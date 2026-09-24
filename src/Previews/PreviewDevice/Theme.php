<?php

declare(strict_types=1);

namespace Courier\Previews\PreviewDevice;

/**
 * Whether the email is rendered in light or dark mode.
 */
enum Theme: string
{
    case LIGHT = 'light';

    case DARK = 'dark';
}
