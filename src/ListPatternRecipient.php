<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send to users in lists matching a pattern.
 *
 * @phpstan-type ListPatternRecipientShape = array{
 *   data?: array<string,mixed>|null, listPattern?: string|null
 * }
 */
final class ListPatternRecipient implements BaseModel
{
    /** @use SdkModel<ListPatternRecipientShape> */
    use SdkModel;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    #[Optional('list_pattern', nullable: true)]
    public ?string $listPattern;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $data
     */
    public static function with(
        ?array $data = null,
        ?string $listPattern = null
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $listPattern && $self['listPattern'] = $listPattern;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    public function withListPattern(?string $listPattern): self
    {
        $self = clone $this;
        $self['listPattern'] = $listPattern;

        return $self;
    }
}
