<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams\Automation;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationAddToDigestStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationCancelStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationDelayStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationInvokeStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationSendListStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationSendStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationThrottleStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep;
use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step\AutomationV2SendStep;
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
