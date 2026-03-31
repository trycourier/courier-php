<?php

declare(strict_types=1);

namespace Courier\RoutingStrategies;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Response returned by create and replace operations.
 *
 * @phpstan-type RoutingStrategyMutationResponseShape = array{id: string}
 */
final class RoutingStrategyMutationResponse implements BaseModel
{
    /** @use SdkModel<RoutingStrategyMutationResponseShape> */
    use SdkModel;

    /**
     * The routing strategy ID (rs_ prefix).
     */
    #[Required]
    public string $id;

    /**
     * `new RoutingStrategyMutationResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyMutationResponse::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyMutationResponse)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    /**
     * The routing strategy ID (rs_ prefix).
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
