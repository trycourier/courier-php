<?php

declare(strict_types=1);

namespace Courier;

enum TextStyle: string
{
    case TEXT = 'text';

    case H1 = 'h1';

    case H2 = 'h2';

    case SUBTEXT = 'subtext';
}
