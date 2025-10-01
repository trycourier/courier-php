<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_step = array{if?: string|null, ref?: string|null}
 */
final class AutomationStep implements BaseModel
{
    /** @use SdkModel<automation_step> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $if;

    #[Api(nullable: true, optional: true)]
    public ?string $ref;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $if = null, ?string $ref = null): self
    {
        $obj = new self;

        null !== $if && $obj->if = $if;
        null !== $ref && $obj->ref = $ref;

        return $obj;
    }

    public function withIf(?string $if): self
    {
        $obj = clone $this;
        $obj->if = $if;

        return $obj;
    }

    public function withRef(?string $ref): self
    {
        $obj = clone $this;
        $obj->ref = $ref;

        return $obj;
    }
}
