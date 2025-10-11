<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep;

enum Merge: string
{
    case NONE = 'none';

    case OVERWRITE = 'overwrite';

    case SOFT_MERGE = 'soft-merge';

    case REPLACE = 'replace';
}
