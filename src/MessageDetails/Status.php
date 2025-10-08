<?php

declare(strict_types=1);

namespace Courier\MessageDetails;

/**
 * The current status of the message.
 */
enum Status: string
{
    case CANCELED = 'CANCELED';

    case CLICKED = 'CLICKED';

    case DELAYED = 'DELAYED';

    case DELIVERED = 'DELIVERED';

    case DIGESTED = 'DIGESTED';

    case ENQUEUED = 'ENQUEUED';

    case FILTERED = 'FILTERED';

    case OPENED = 'OPENED';

    case ROUTED = 'ROUTED';

    case SENT = 'SENT';

    case SIMULATED = 'SIMULATED';

    case THROTTLED = 'THROTTLED';

    case UNDELIVERABLE = 'UNDELIVERABLE';

    case UNMAPPED = 'UNMAPPED';

    case UNROUTABLE = 'UNROUTABLE';
}
