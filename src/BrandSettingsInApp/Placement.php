<?php

declare(strict_types=1);

namespace Courier\BrandSettingsInApp;

enum Placement: string
{
    case TOP = 'top';

    case BOTTOM = 'bottom';

    case LEFT = 'left';

    case RIGHT = 'right';
}
