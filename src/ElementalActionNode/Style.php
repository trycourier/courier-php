<?php

declare(strict_types=1);

namespace Courier\ElementalActionNode;

/**
 * Defaults to `button`.
 */
enum Style: string
{
    case BUTTON = 'button';

    case LINK = 'link';
}
