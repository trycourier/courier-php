<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\Metadata;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type utm_alias = array{
 *   campaign?: string|null,
 *   content?: string|null,
 *   medium?: string|null,
 *   source?: string|null,
 *   term?: string|null,
 * }
 */
final class Utm implements BaseModel
{
    /** @use SdkModel<utm_alias> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $campaign;

    #[Api(nullable: true, optional: true)]
    public ?string $content;

    #[Api(nullable: true, optional: true)]
    public ?string $medium;

    #[Api(nullable: true, optional: true)]
    public ?string $source;

    #[Api(nullable: true, optional: true)]
    public ?string $term;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $campaign = null,
        ?string $content = null,
        ?string $medium = null,
        ?string $source = null,
        ?string $term = null,
    ): self {
        $obj = new self;

        null !== $campaign && $obj->campaign = $campaign;
        null !== $content && $obj->content = $content;
        null !== $medium && $obj->medium = $medium;
        null !== $source && $obj->source = $source;
        null !== $term && $obj->term = $term;

        return $obj;
    }

    public function withCampaign(?string $campaign): self
    {
        $obj = clone $this;
        $obj->campaign = $campaign;

        return $obj;
    }

    public function withContent(?string $content): self
    {
        $obj = clone $this;
        $obj->content = $content;

        return $obj;
    }

    public function withMedium(?string $medium): self
    {
        $obj = clone $this;
        $obj->medium = $medium;

        return $obj;
    }

    public function withSource(?string $source): self
    {
        $obj = clone $this;
        $obj->source = $source;

        return $obj;
    }

    public function withTerm(?string $term): self
    {
        $obj = clone $this;
        $obj->term = $term;

        return $obj;
    }
}
