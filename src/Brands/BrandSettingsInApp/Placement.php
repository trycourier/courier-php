<?php

declare(strict_types=1);

namespace Courier\Brands\BrandSettingsInApp;

enum Placement: string
{
    case TOP = 'top';

    case BOTTOM = 'bottom';

    case LEFT = 'left';

    case RIGHT = 'right';
}
