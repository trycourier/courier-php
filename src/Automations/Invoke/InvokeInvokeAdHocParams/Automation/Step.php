<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToDigestStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationThrottleStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationV2SendStep;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;

final class Step implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            AutomationAddToDigestStep::class,
            AutomationAddToBatchStep::class,
            AutomationThrottleStep::class,
            AutomationCancelStep::class,
            AutomationDelayStep::class,
            AutomationFetchDataStep::class,
            AutomationInvokeStep::class,
            AutomationSendStep::class,
            AutomationV2SendStep::class,
            AutomationSendListStep::class,
            AutomationUpdateProfileStep::class,
        ];
    }
}
