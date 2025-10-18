<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkResponse;
use Courier\Core\Contracts\BaseModel;
use Courier\Core\Conversion\Contracts\ResponseConverter;
use Courier\Notifications\Check;

/**
 * @phpstan-type check_list_response = array{checks: list<Check>}
 */
final class CheckListResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<check_list_response> */
    use SdkModel;

    use SdkResponse;

    /** @var list<Check> $checks */
    #[Api(list: Check::class)]
    public array $checks;

    /**
     * `new CheckListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckListResponse::with(checks: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckListResponse)->withChecks(...)
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
