<?php

declare(strict_types=1);

namespace Courier\Automations\AutomationInvokeAdHocParams;

use Courier\Automations\AutomationInvokeAdHocParams\Automation\Step;
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
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_alias = array{
 *   steps: list<automation_add_to_digest_step|automation_add_to_batch_step|automation_throttle_step|automation_cancel_step|automation_delay_step|automation_fetch_data_step|automation_invoke_step|automation_send_step|automation_v2_send_step|automation_send_list_step|AutomationUpdateProfileStep>,
 *   cancelationToken?: string|null,
 * }
 */
final class Automation implements BaseModel
{
    /** @use SdkModel<automation_alias> */
    use SdkModel;

    /**
     * @var list<AutomationAddToDigestStep|AutomationAddToBatchStep|AutomationThrottleStep|AutomationCancelStep|AutomationDelayStep|AutomationFetchDataStep|AutomationInvokeStep|AutomationSendStep|AutomationV2SendStep|AutomationSendListStep|AutomationUpdateProfileStep> $steps
     */
    #[Api(list: Step::class)]
    public array $steps;

    #[Api('cancelation_token', nullable: true, optional: true)]
    public ?string $cancelationToken;

    /**
     * `new Automation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Automation::with(steps: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Automation)->withSteps(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AutomationAddToDigestStep|AutomationAddToBatchStep|AutomationThrottleStep|AutomationCancelStep|AutomationDelayStep|AutomationFetchDataStep|AutomationInvokeStep|AutomationSendStep|AutomationV2SendStep|AutomationSendListStep|AutomationUpdateProfileStep> $steps
     */
    public static function with(
        array $steps,
        ?string $cancelationToken = null
    ): self {
        $obj = new self;

        $obj->steps = $steps;

        null !== $cancelationToken && $obj->cancelationToken = $cancelationToken;

        return $obj;
    }

    /**
     * @param list<AutomationAddToDigestStep|AutomationAddToBatchStep|AutomationThrottleStep|AutomationCancelStep|AutomationDelayStep|AutomationFetchDataStep|AutomationInvokeStep|AutomationSendStep|AutomationV2SendStep|AutomationSendListStep|AutomationUpdateProfileStep> $steps
     */
    public function withSteps(array $steps): self
    {
        $obj = clone $this;
        $obj->steps = $steps;

        return $obj;
    }

    public function withCancelationToken(?string $cancelationToken): self
    {
        $obj = clone $this;
        $obj->cancelationToken = $cancelationToken;

        return $obj;
    }
}
