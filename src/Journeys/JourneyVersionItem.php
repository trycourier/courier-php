<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type JourneyVersionItemShape = array{
 *   created: int|null,
 *   creator: string|null,
 *   name: string,
 *   published: int|null,
 *   version: string,
 * }
 */
final class JourneyVersionItem implements BaseModel
{
    /** @use SdkModel<JourneyVersionItemShape> */
    use SdkModel;

    #[Required]
    public ?int $created;

    #[Required]
    public ?string $creator;

    #[Required]
    public string $name;

    #[Required]
    public ?int $published;

    #[Required]
    public string $version;

    /**
     * `new JourneyVersionItem()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * JourneyVersionItem::with(
     *   created: ..., creator: ..., name: ..., published: ..., version: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new JourneyVersionItem)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withName(...)
     *   ->withPublished(...)
     *   ->withVersion(...)
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
    public static function with(
        ?int $created,
        ?string $creator,
        string $name,
        ?int $published,
        string $version,
    ): self {
        $self = new self;

        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['name'] = $name;
        $self['published'] = $published;
        $self['version'] = $version;

        return $self;
    }

    public function withCreated(?int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    public function withCreator(?string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withPublished(?int $published): self
    {
        $self = clone $this;
        $self['published'] = $published;

        return $self;
    }

    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
