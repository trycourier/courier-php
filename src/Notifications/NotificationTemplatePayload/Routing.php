<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplatePayload;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Routing strategy reference, or null for none.
 *
 * @phpstan-type RoutingShape = array{strategyID: string}
 */
final class Routing implements BaseModel
{
    /** @use SdkModel<RoutingShape> */
    use SdkModel;

    #[Required('strategy_id')]
    public string $strategyID;

    /**
     * `new Routing()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Routing::with(strategyID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Routing)->withStrategyID(...)
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
    public static function with(string $strategyID): self
    {
        $self = new self;

        $self['strategyID'] = $strategyID;

        return $self;
    }

    public function withStrategyID(string $strategyID): self
    {
        $self = clone $this;
        $self['strategyID'] = $strategyID;

        return $self;
    }
}
