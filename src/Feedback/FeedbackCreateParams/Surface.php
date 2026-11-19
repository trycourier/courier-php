<?php

declare(strict_types=1);

namespace Courier\Feedback\FeedbackCreateParams;

/**
 * Where you met the problem: the REST `api`, an `sdk`, the Courier `mcp` server, the Courier app `ui`, the `docs`, or `other`.
 */
enum Surface: string
{
    case API = 'api';

    case SDK = 'sdk';

    case MCP = 'mcp';

    case UI = 'ui';

    case DOCS = 'docs';

    case OTHER = 'other';
}
