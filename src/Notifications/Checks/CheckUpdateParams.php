<?php

declare(strict_types=1);

namespace Courier\Notifications\Checks;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new CheckUpdateParams); // set properties as needed
 * $client->notifications.checks->update(...$params->toArray());
 * ```.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->notifications.checks->update(...$params->toArray());`
 *
 * @see Courier\Notifications\Checks->update
 *
 * @phpstan-type check_update_params = array{id: string, checks: list<BaseCheck>}
 */
final class CheckUpdateParams implements BaseModel
{
    /** @use SdkModel<check_update_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $id;

    /** @var list<BaseCheck> $checks */
    #[Api(list: BaseCheck::class)]
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
     * @param list<BaseCheck> $checks
     */
    public static function with(string $id, array $checks): self
    {
        $obj = new self;

        $obj->id = $id;
        $obj->checks = $checks;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    /**
     * @param list<BaseCheck> $checks
     */
    public function withChecks(array $checks): self
    {
        $obj = clone $this;
        $obj->checks = $checks;

        return $obj;
    }
}
