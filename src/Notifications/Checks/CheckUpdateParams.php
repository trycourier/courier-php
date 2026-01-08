<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\BaseCheck;

/**
 * @see Courier\Services\Notifications\ChecksService::update()
 *
 * @phpstan-import-type BaseCheckShape from \Courier\Notifications\BaseCheck
 *
 * @phpstan-type CheckUpdateParamsShape = array{
 *   id: string, checks: list<BaseCheck|BaseCheckShape>
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
     * @param list<BaseCheck|BaseCheckShape> $checks
     */
    public static function with(string $id, array $checks): self
    {
        $self = new self;

        $self['id'] = $id;
        $self['checks'] = $checks;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param list<BaseCheck|BaseCheckShape> $checks
     */
    public function withChecks(array $checks): self
    {
        $self = clone $this;
        $self['checks'] = $checks;

        return $self;
    }
}
