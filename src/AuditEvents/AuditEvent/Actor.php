<?php

declare(strict_types=1);

namespace Courier\AuditEvents\AuditEvent;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type actor_alias = array{id: string, email?: string|null}
 */
final class Actor implements BaseModel
{
    /** @use SdkModel<actor_alias> */
    use SdkModel;

    #[Api]
    public string $id;

    #[Api(nullable: true, optional: true)]
    public ?string $email;

    /**
     * `new Actor()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Actor::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Actor)->withID(...)
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
    public static function with(string $id, ?string $email = null): self
    {
        $obj = new self;

        $obj->id = $id;

        null !== $email && $obj->email = $email;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withEmail(?string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }
}
