<?php

declare(strict_types=1);

namespace Courier\Send\ElementalNode\UnionMember4;

/**
 * The alignment of the action button. Defaults to "center".
 */
enum Align: string
{
    case CENTER = 'center';

    case LEFT = 'left';

    case RIGHT = 'right';

    case FULL = 'full';
}
