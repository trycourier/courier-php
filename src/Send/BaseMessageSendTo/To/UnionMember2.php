<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type union_member2 = array{
 *   data?: array<string, mixed>|null, listPattern?: string|null
 * }
 */
final class UnionMember2 implements BaseModel
{
    /** @use SdkModel<union_member2> */
    use SdkModel;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    #[Api('list_pattern', nullable: true, optional: true)]
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
     * @param array<string, mixed>|null $data
     */
    public static function with(
        ?array $data = null,
        ?string $listPattern = null
    ): self {
        $obj = new self;

        null !== $data && $obj->data = $data;
        null !== $listPattern && $obj->listPattern = $listPattern;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    public function withListPattern(?string $listPattern): self
    {
        $obj = clone $this;
        $obj->listPattern = $listPattern;

        return $obj;
    }
}
