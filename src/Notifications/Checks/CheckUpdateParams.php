<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\BaseCheck\Status;
use Courier\Notifications\BaseCheck\Type;

/**
 * @see Courier\Services\Notifications\ChecksService::update()
 *
 * @phpstan-type CheckUpdateParamsShape = array{
 *   id: string,
 *   checks: list<BaseCheck|array{
 *     id: string, status: value-of<Status>, type: value-of<Type>
 *   }>,
 * }
 */
final class CheckUpdateParams implements BaseModel
{
    /** @use SdkModel<CheckUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $id;

    /** @var list<BaseCheck> $checks */
    #[Required(list: BaseCheck::class)]
    public array $checks;

    /**
     * `new CheckUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * CheckUpdateParams::with(id: ..., checks: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new CheckUpdateParams)->withID(...)->withChecks(...)
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
     * @param list<BaseCheck|array{
     *   id: string, status: value-of<Status>, type: value-of<Type>
     * }> $checks
     */
    public static function with(string $id, array $checks): self
    {
        $obj = new self;

        $obj['id'] = $id;
        $obj['checks'] = $checks;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * @param list<BaseCheck|array{
     *   id: string, status: value-of<Status>, type: value-of<Type>
     * }> $checks
     */
    public function withChecks(array $checks): self
    {
        $obj = clone $this;
        $obj['checks'] = $checks;

        return $obj;
    }
}
