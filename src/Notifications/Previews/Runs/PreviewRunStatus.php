<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

/**
 * Where the run itself has got to. `PENDING` and `RENDERED` mean Courier is still preparing the email, `SUBMITTED` means it is with the rendering service, and `COMPLETED` means every device has reported. `FAILED` is the run as a whole failing — an individual device failing never fails the run.
 */
enum PreviewRunStatus: string
{
    case PENDING = 'PENDING';

    case RENDERED = 'RENDERED';

    case SUBMITTED = 'SUBMITTED';

    case COMPLETED = 'COMPLETED';

    case FAILED = 'FAILED';
}
