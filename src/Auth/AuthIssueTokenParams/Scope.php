<?php

declare(strict_types=1);

namespace Courier\Auth\AuthIssueTokenParams;

enum Scope: string
{
    case READ_PREFERENCES = 'read:preferences';

    case WRITE_PREFERENCES = 'write:preferences';

    case READ_USER_TOKENS = 'read:user-tokens';

    case WRITE_USER_TOKENS = 'write:user-tokens';

    case READ_BRANDS = 'read:brands';

    case WRITE_BRANDS = 'write:brands';

    case READ_BRANDS_ID = 'read:brands{:id}';

    case WRITE_BRANDS_ID = 'write:brands{:id}';

    case WRITE_TRACK = 'write:track';

    case INBOX_READ_MESSAGES = 'inbox:read:messages';

    case INBOX_WRITE_MESSAGES = 'inbox:write:messages';

    case INBOX_WRITE_EVENT = 'inbox:write:event';

    case INBOX_WRITE_EVENTS = 'inbox:write:events';

    case USER_ID_YOUR_USER_ID = 'user_id:$YOUR_USER_ID';
}
