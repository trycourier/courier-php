<?php

declare(strict_types=1);

namespace Courier\ElementalContent;

/**
 * How template variables read the data sent with the message. Under `strict`, data fields are read only through the `data.` prefix, as in `{{data.name}}`. Under `default`, `data` is spread onto the root, so `{{name}}` resolves and `{{data.name}}` renders as an empty string. Templates saved in Design Studio are `strict`. When omitted, the content is `default`. A write that replaces a template's content resets it to `default` unless the request sends `scope` again.
 */
enum Scope: string
{
    case DEFAULT = 'default';

    case STRICT = 'strict';
}
