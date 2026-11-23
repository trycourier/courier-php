<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationContentPutRequest\Content;

/**
 * How template variables read the data sent with the message. Under `strict`, data fields are read only through the `data.` prefix, as in `{{data.name}}`. Under `default`, `data` is spread onto the root, so `{{name}}` resolves and `{{data.name}}` renders as an empty string. This request replaces the stored content, so omitting `scope` resets it to `default`.
 */
enum Scope: string
{
    case DEFAULT = 'default';

    case STRICT = 'strict';
}
