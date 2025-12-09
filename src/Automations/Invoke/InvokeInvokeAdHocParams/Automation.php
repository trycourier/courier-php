<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationCancelStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep\Action;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\MergeStrategy;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationInvokeStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendListStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationUpdateProfileStep\Merge;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationShape = array{
 *   steps: list<AutomationDelayStep|AutomationSendStep|AutomationSendListStep|AutomationUpdateProfileStep|AutomationCancelStep|AutomationFetchDataStep|AutomationInvokeStep>,
 *   cancelationToken?: string|null,
 * }
 */
final class Automation implements BaseModel
{
    /** @use SdkModel<AutomationShape> */
    use SdkModel;

    /**
     * @var list<AutomationDelayStep|AutomationSendStep|AutomationSendListStep|AutomationUpdateProfileStep|AutomationCancelStep|AutomationFetchDataStep|AutomationInvokeStep> $steps
     */
    #[Required(list: Step::class)]
    public array $steps;

    #[Optional('cancelation_token', nullable: true)]
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
     * @param list<AutomationDelayStep|array{
     *   action: value-of<Action>, duration?: string|null, until?: string|null
     * }|AutomationSendStep|array{
     *   action: value-of<AutomationSendStep\Action>,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   profile?: array<string,mixed>|null,
     *   recipient?: string|null,
     *   template?: string|null,
     * }|AutomationSendListStep|array{
     *   action: value-of<AutomationSendListStep\Action>,
     *   list: string,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     * }|AutomationUpdateProfileStep|array{
     *   action: value-of<AutomationUpdateProfileStep\Action>,
     *   profile: array<string,mixed>,
     *   merge?: value-of<Merge>|null,
     *   recipientID?: string|null,
     * }|AutomationCancelStep|array{
     *   action: value-of<AutomationCancelStep\Action>,
     *   cancelationToken: string,
     * }|AutomationFetchDataStep|array{
     *   action: value-of<AutomationFetchDataStep\Action>,
     *   webhook: Webhook,
     *   mergeStrategy?: value-of<MergeStrategy>|null,
     * }|AutomationInvokeStep|array{
     *   action: value-of<AutomationInvokeStep\Action>,
     *   template: string,
     * }> $steps
     */
    public static function with(
        array $steps,
        ?string $cancelationToken = null
    ): self {
        $obj = new self;

        $obj['steps'] = $steps;

        null !== $cancelationToken && $obj['cancelationToken'] = $cancelationToken;

        return $obj;
    }

    /**
     * @param list<AutomationDelayStep|array{
     *   action: value-of<Action>, duration?: string|null, until?: string|null
     * }|AutomationSendStep|array{
     *   action: value-of<AutomationSendStep\Action>,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   profile?: array<string,mixed>|null,
     *   recipient?: string|null,
     *   template?: string|null,
     * }|AutomationSendListStep|array{
     *   action: value-of<AutomationSendListStep\Action>,
     *   list: string,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     * }|AutomationUpdateProfileStep|array{
     *   action: value-of<AutomationUpdateProfileStep\Action>,
     *   profile: array<string,mixed>,
     *   merge?: value-of<Merge>|null,
     *   recipientID?: string|null,
     * }|AutomationCancelStep|array{
     *   action: value-of<AutomationCancelStep\Action>,
     *   cancelationToken: string,
     * }|AutomationFetchDataStep|array{
     *   action: value-of<AutomationFetchDataStep\Action>,
     *   webhook: Webhook,
     *   mergeStrategy?: value-of<MergeStrategy>|null,
     * }|AutomationInvokeStep|array{
     *   action: value-of<AutomationInvokeStep\Action>,
     *   template: string,
     * }> $steps
     */
    public function withSteps(array $steps): self
    {
        $obj = clone $this;
        $obj['steps'] = $steps;

        return $obj;
    }

    public function withCancelationToken(?string $cancelationToken): self
    {
        $obj = clone $this;
        $obj['cancelationToken'] = $cancelationToken;

        return $obj;
    }
}
