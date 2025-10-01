<?php

declare(strict_types=1);

namespace Courier\Users\Tokens\TokenGetSingleResponse;

enum Status: string
{
    case ACTIVE = 'active';

    case UNKNOWN = 'unknown';

    case FAILED = 'failed';

    case REVOKED = 'revoked';
}
