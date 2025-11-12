<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationShape = array{
 *   steps: list<AutomationDelayStep|AutomationSendStep|AutomationSendListStep|AutomationUpdateProfileStep|AutomationCancelStep|AutomationFetchDataStep|AutomationInvokeStep>,
 *   cancelation_token?: string|null,
 * }
 */
final class Automation implements BaseModel
{
    /** @use SdkModel<AutomationShape> */
    use SdkModel;

    /**
     * @var list<AutomationDelayStep|AutomationSendStep|AutomationSendListStep|AutomationUpdateProfileStep|AutomationCancelStep|AutomationFetchDataStep|AutomationInvokeStep> $steps
     */
    #[Api(list: Step::class)]
    public array $steps;

    #[Api(nullable: true, optional: true)]
    public ?string $cancelation_token;

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
     * @param list<AutomationDelayStep|AutomationSendStep|AutomationSendListStep|AutomationUpdateProfileStep|AutomationCancelStep|AutomationFetchDataStep|AutomationInvokeStep> $steps
     */
    public static function with(
        array $steps,
        ?string $cancelation_token = null
    ): self {
        $obj = new self;

        $obj->steps = $steps;

        null !== $cancelation_token && $obj->cancelation_token = $cancelation_token;

        return $obj;
    }

    /**
     * @param list<AutomationDelayStep|AutomationSendStep|AutomationSendListStep|AutomationUpdateProfileStep|AutomationCancelStep|AutomationFetchDataStep|AutomationInvokeStep> $steps
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
        $obj->cancelation_token = $cancelationToken;

        return $obj;
    }
}
