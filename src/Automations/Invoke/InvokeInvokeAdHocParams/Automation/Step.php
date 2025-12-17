<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

/**
 * @phpstan-import-type AutomationDelayStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep
 * @phpstan-import-type AutomationSendStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep
 * @phpstan-import-type AutomationSendListStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep
 * @phpstan-import-type AutomationUpdateProfileStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep
 * @phpstan-import-type AutomationCancelStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep
 * @phpstan-import-type AutomationFetchDataStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep
 * @phpstan-import-type AutomationInvokeStepShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep
 *
 * @phpstan-type StepShape = AutomationDelayStepShape|AutomationSendStepShape|AutomationSendListStepShape|AutomationUpdateProfileStepShape|AutomationCancelStepShape|AutomationFetchDataStepShape|AutomationInvokeStepShape
 */
final class Step implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            AutomationDelayStep::class,
            AutomationSendStep::class,
            AutomationSendListStep::class,
            AutomationUpdateProfileStep::class,
            AutomationCancelStep::class,
            AutomationFetchDataStep::class,
            AutomationInvokeStep::class,
        ];
    }
}
