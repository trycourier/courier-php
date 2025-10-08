<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Check;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;

/**
 * @phpstan-type check_update_response = array{checks: list<Check>}
 */
final class CheckUpdateResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<check_update_response> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Check> $checks */
    #[Api(list: Check::class)]
    public array $checks;

    /**
     * `new CheckUpdateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckUpdateResponse::with(checks: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckUpdateResponse)->withChecks(...)
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
     * @param list<Check> $checks
     */
    public static function with(array $checks): self
    {
        $obj = new self;

        $obj->checks = $checks;

        return $obj;
    }

    /**
     * @param list<Check> $checks
     */
    public function withChecks(array $checks): self
    {
        $obj = clone $this;
        $obj->checks = $checks;

        return $obj;
    }
}
