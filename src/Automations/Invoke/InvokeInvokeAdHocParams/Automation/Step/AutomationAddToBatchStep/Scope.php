<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep;

/**
 * Determine the scope of the batching. If user, chosen in this order: recipient, profile.user_id, data.user_id, data.userId.
 * If dynamic, then specify where the batch_key or a reference to the batch_key.
 */
enum Scope: string
{
    case USER = 'user';

    case GLOBAL = 'global';

    case DYNAMIC = 'dynamic';
}
