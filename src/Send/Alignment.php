<?php

declare(strict_types=1);

namespace Courier\Send;

enum Alignment: string
{
    case CENTER = 'center';

    case LEFT = 'left';

    case RIGHT = 'right';

    case FULL = 'full';
}
