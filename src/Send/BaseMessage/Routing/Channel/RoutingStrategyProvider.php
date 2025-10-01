<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage\Routing\Channel;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyProvider\Metadata;

/**
 * @phpstan-type routing_strategy_provider = array{
 *   metadata: Metadata,
 *   name: string,
 *   config?: array<string, mixed>|null,
 *   if?: string|null,
 * }
 */
final class RoutingStrategyProvider implements BaseModel
{
    /** @use SdkModel<routing_strategy_provider> */
    use SdkModel;

    #[Api]
    public Metadata $metadata;

    #[Api]
    public string $name;

    /** @var array<string, mixed>|null $config */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $config;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    /**
     * `new RoutingStrategyProvider()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * RoutingStrategyProvider::with(metadata: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new RoutingStrategyProvider)->withMetadata(...)->withName(...)
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
     * @param array<string, mixed>|null $config
     */
    public static function with(
        Metadata $metadata,
        string $name,
        ?array $config = null,
        ?string $if = null
    ): self {
        $obj = new self;

        $obj->metadata = $metadata;
        $obj->name = $name;

        null !== $config && $obj->config = $config;
        null !== $if && $obj->if = $if;

        return $obj;
    }

    public function withMetadata(Metadata $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj->name = $name;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $config
     */
    public function withConfig(?array $config): self
    {
        $obj = clone $this;
        $obj->config = $config;

        return $obj;
    }

    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }
}
