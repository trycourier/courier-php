<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\BaseCheck\Status;
use Courier\Notifications\BaseCheck\Type;
use Courier\Notifications\Check;

/**
 * @phpstan-type CheckUpdateResponseShape = array{checks: list<Check>}
 */
final class CheckUpdateResponse implements BaseModel
{
    /** @use SdkModel<CheckUpdateResponseShape> */
    use SdkModel;

    /** @var list<Check> $checks */
    #[Required(list: Check::class)]
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
     * @param list<Check|array{
     *   id: string, status: value-of<Status>, type: value-of<Type>, updated: int
     * }> $checks
     */
    public static function with(array $checks): self
    {
        $obj = new self;

        $obj['checks'] = $checks;

        return $obj;
    }

    /**
     * @param list<Check|array{
     *   id: string, status: value-of<Status>, type: value-of<Type>, updated: int
     * }> $checks
     */
    public function withChecks(array $checks): self
    {
        $obj = clone $this;
        $obj['checks'] = $checks;

        return $obj;
    }
}
