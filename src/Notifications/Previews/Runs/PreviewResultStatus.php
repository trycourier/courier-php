<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

/**
 * One device's outcome. `COMPLETED` means the screenshot exists and its URLs are populated. `UNSUPPORTED`, `TIMED_OUT` and `FAILED` are all terminal, and none stands in for another — `UNSUPPORTED` means the device was retired at the vendor, `TIMED_OUT` means it did not report in time.
 */
enum PreviewResultStatus: string
{
    case PENDING = 'PENDING';

    case PROCESSING = 'PROCESSING';

    case COMPLETED = 'COMPLETED';

    case UNSUPPORTED = 'UNSUPPORTED';

    case TIMED_OUT = 'TIMED_OUT';

    case FAILED = 'FAILED';
}
