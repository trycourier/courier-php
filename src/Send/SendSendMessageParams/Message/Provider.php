<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\SendSendMessageParams\Message\Provider\Metadata;

/**
 * @phpstan-type provider_alias = array{
 *   if?: string|null,
 *   metadata?: Metadata|null,
 *   override?: array<string, mixed>|null,
 *   timeouts?: int|null,
 * }
 */
final class Provider implements BaseModel
{
    /** @use SdkModel<provider_alias> */
    use SdkModel;

    /**
     * JS conditional with access to data/profile.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?Metadata $metadata;

    /**
     * Provider-specific overrides.
     *
     * @var array<string, mixed>|null $override
     */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $override;

    #[Api(nullable: true, optional: true)]
    public ?int $timeouts;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, mixed>|null $override
     */
    public static function with(
        ?string $if = null,
        ?Metadata $metadata = null,
        ?array $override = null,
        ?int $timeouts = null,
    ): self {
        $obj = new self;

        null !== $if && $obj->if = $if;
        null !== $metadata && $obj->metadata = $metadata;
        null !== $override && $obj->override = $override;
        null !== $timeouts && $obj->timeouts = $timeouts;

        return $obj;
    }

    /**
     * JS conditional with access to data/profile.
     */
    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }

    public function withMetadata(?Metadata $metadata): self
    {
        $obj = clone $this;
        $obj->metadata = $metadata;

        return $obj;
    }

    /**
     * Provider-specific overrides.
     *
     * @param array<string, mixed>|null $override
     */
    public function withOverride(?array $override): self
    {
        $obj = clone $this;
        $obj->override = $override;

        return $obj;
    }

    public function withTimeouts(?int $timeouts): self
    {
        $obj = clone $this;
        $obj->timeouts = $timeouts;

        return $obj;
    }
}
