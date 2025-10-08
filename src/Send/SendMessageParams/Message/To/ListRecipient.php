<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\To;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type list_recipient = array{
 *   data?: array<string, mixed>|null, listID?: string|null
 * }
 */
final class ListRecipient implements BaseModel
{
    /** @use SdkModel<list_recipient> */
    use SdkModel;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    #[Api('list_id', nullable: true, optional: true)]
    public ?string $listID;

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
        ?string $listID = null
    ): self {
        $obj = new self;

        null !== $data && $obj->data = $data;
        null !== $listID && $obj->listID = $listID;

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

    public function withListID(?string $listID): self
    {
        $obj = clone $this;
        $obj->listID = $listID;

        return $obj;
    }
}
