<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationAddToBatchStep\Retain\Type;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Defines what items should be retained and passed along to the next steps when the batch is released.
 *
 * @phpstan-type retain_alias = array{
 *   count: int, type: value-of<Type>, sortKey?: string|null
 * }
 */
final class Retain implements BaseModel
{
    /** @use SdkModel<retain_alias> */
    use SdkModel;

    /**
     * The number of records to keep in batch. Default is 10 and only configurable by requesting from support.
     * When configurable minimum is 2 and maximum is 100.
     */
    #[Api]
    public int $count;

    /**
     * Keep N number of notifications based on the type. First/Last N based on notification received.
     * highest/lowest based on a scoring key providing in the data accessed by sort_key.
     *
     * @var value-of<Type> $type
     */
    #[Api(enum: Type::class)]
    public string $type;

    /**
     * Defines the data value data[sort_key] that is used to sort the stored items. Required when type is set to highest or lowest.
     */
    #[Api('sort_key', nullable: true, optional: true)]
    public ?string $sortKey;

    /**
     * `new Retain()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Retain::with(count: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Retain)->withCount(...)->withType(...)
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        int $count,
        Type|string $type,
        ?string $sortKey = null
    ): self {
        $obj = new self;

        $obj->count = $count;
        $obj->type = $type instanceof Type ? $type->value : $type;

        null !== $sortKey && $obj->sortKey = $sortKey;

        return $obj;
    }

    /**
     * The number of records to keep in batch. Default is 10 and only configurable by requesting from support.
     * When configurable minimum is 2 and maximum is 100.
     */
    public function withCount(int $count): self
    {
        $obj = clone $this;
        $obj->count = $count;

        return $obj;
    }

    /**
     * Keep N number of notifications based on the type. First/Last N based on notification received.
     * highest/lowest based on a scoring key providing in the data accessed by sort_key.
     *
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj->type = $type instanceof Type ? $type->value : $type;

        return $obj;
    }

    /**
     * Defines the data value data[sort_key] that is used to sort the stored items. Required when type is set to highest or lowest.
     */
    public function withSortKey(?string $sortKey): self
    {
        $obj = clone $this;
        $obj->sortKey = $sortKey;

        return $obj;
    }
}
