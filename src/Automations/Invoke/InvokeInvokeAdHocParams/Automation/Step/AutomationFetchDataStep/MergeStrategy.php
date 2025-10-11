<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;

enum MergeStrategy: string
{
    case REPLACE = 'replace';

    case OVERWRITE = 'overwrite';

    case SOFT_MERGE = 'soft-merge';
}
