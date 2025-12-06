<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationInvokeResponseShape = array{runId: string}
 */
final class AutomationInvokeResponse implements BaseModel
{
    /** @use SdkModel<AutomationInvokeResponseShape> */
    use SdkModel;

    #[Api]
    public string $runId;

    /**
     * `new AutomationInvokeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationInvokeResponse::with(runId: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationInvokeResponse)->withRunID(...)
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
     */
    public static function with(string $runId): self
    {
        $obj = new self;

        $obj['runId'] = $runId;

        return $obj;
    }

    public function withRunID(string $runID): self
    {
        $obj = clone $this;
        $obj['runId'] = $runID;

        return $obj;
    }
}
