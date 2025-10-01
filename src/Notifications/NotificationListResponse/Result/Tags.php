<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse\Result;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationListResponse\Result\Tags\Data;

/**
 * @phpstan-type tags_alias = array{data: list<Data>}
 */
final class Tags implements BaseModel
{
    /** @use SdkModel<tags_alias> */
    use SdkModel;

    /** @var list<Data> $data */
    #[Api(list: Data::class)]
    public array $data;

    /**
     * `new Tags()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Tags::with(data: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Tags)->withData(...)
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
     * @param list<Data> $data
     */
    public static function with(array $data): self
    {
        $obj = new self;

        $obj->data = $data;

        return $obj;
    }

    /**
     * @param list<Data> $data
     */
    public function withData(array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }
}
