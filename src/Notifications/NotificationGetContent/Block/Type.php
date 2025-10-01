<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent\Block;

enum Type: string
{
    case ACTION = 'action';

    case DIVIDER = 'divider';

    case IMAGE = 'image';

    case JSONNET = 'jsonnet';

    case LIST = 'list';

    case MARKDOWN = 'markdown';

    case QUOTE = 'quote';

    case TEMPLATE = 'template';

    case TEXT = 'text';
}
