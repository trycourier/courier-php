<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationListResponse\Result;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Notifications\NotificationListResponse\Result\Tags\Data;

/**
 * @phpstan-type TagsShape = array{data: list<Data>}
 */
final class Tags implements BaseModel
{
    /** @use SdkModel<TagsShape> */
    use SdkModel;

    /** @var list<Data> $data */
    #[Required(list: Data::class)]
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
     * @param list<Data|array{id: string, name: string}> $data
     */
    public static function with(array $data): self
    {
        $self = new self;

        $self['data'] = $data;

        return $self;
    }

    /**
     * @param list<Data|array{id: string, name: string}> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }
}
