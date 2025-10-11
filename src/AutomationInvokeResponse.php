<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_invoke_response = array{runID: string}
 */
final class AutomationInvokeResponse implements BaseModel
{
    /** @use SdkModel<automation_invoke_response> */
    use SdkModel;

    #[Api('runId')]
    public string $runID;

    /**
     * `new AutomationInvokeResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationInvokeResponse::with(runID: ...)
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
    public static function with(string $runID): self
    {
        $obj = new self;

        $obj->runID = $runID;

        return $obj;
    }

    public function withRunID(string $runID): self
    {
        $obj = clone $this;
        $obj->runID = $runID;

        return $obj;
    }
}
