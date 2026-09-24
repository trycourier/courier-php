<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

/**
 * Why one device's render failed, when its `status` is `FAILED` and the cause has a public name. `DELIVERY_FAILED` means the rendering service could not deliver the message to its own capture mailbox — infrastructure, not anything wrong with the template.
 */
enum PreviewResultFailureReason: string
{
    case DELIVERY_FAILED = 'DELIVERY_FAILED';
}
