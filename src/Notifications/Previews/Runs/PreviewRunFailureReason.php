<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

/**
 * Why the run failed, when `status` is `FAILED`. `NO_EMAIL_CHANNEL` and `TEMPLATE_NOT_SUPPORTED` mean there was nothing to render; `ALL_DEVICES_UNSUPPORTED` means every requested device has been retired and the request can be fixed by choosing others.
 */
enum PreviewRunFailureReason: string
{
    case TEMPLATE_NOT_SUPPORTED = 'TEMPLATE_NOT_SUPPORTED';

    case NO_EMAIL_CHANNEL = 'NO_EMAIL_CHANNEL';

    case RENDER_FAILED = 'RENDER_FAILED';

    case ALL_DEVICES_UNSUPPORTED = 'ALL_DEVICES_UNSUPPORTED';

    case VENDOR_ERROR = 'VENDOR_ERROR';
}
