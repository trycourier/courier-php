<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SubscriptionListShape = array{
 *   id: string, name: string, created?: string|null, updated?: string|null
 * }
 */
final class SubscriptionList implements BaseModel
{
    /** @use SdkModel<SubscriptionListShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $name;

    #[Optional(nullable: true)]
    public ?string $created;

    #[Optional(nullable: true)]
    public ?string $updated;

    /**
     * `new SubscriptionList()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionList::with(id: ..., name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionList)->withID(...)->withName(...)
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
        string $id,
        string $name,
        ?string $created = null,
        ?string $updated = null
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['name'] = $name;

        null !== $created && $self['created'] = $created;
        null !== $updated && $self['updated'] = $updated;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withCreated(?string $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    public function withUpdated(?string $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }
}
