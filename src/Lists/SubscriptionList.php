<?php

declare(strict_types=1);

namespace Courier\Lists;

use Courier\Core\Attributes\Api;
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

    #[Api]
    public string $id;

    #[Api]
    public string $name;

    #[Api(nullable: true, optional: true)]
    public ?string $created;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        $obj['id'] = $id;
        $obj['name'] = $name;

        null !== $created && $obj['created'] = $created;
        null !== $updated && $obj['updated'] = $updated;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withName(string $name): self
    {
        $obj = clone $this;
        $obj['name'] = $name;

        return $obj;
    }

    public function withCreated(?string $created): self
    {
        $obj = clone $this;
        $obj['created'] = $created;

        return $obj;
    }

    public function withUpdated(?string $updated): self
    {
        $obj = clone $this;
        $obj['updated'] = $updated;

        return $obj;
    }
}
