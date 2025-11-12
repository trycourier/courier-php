<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkListUsersResponse;

use Courier\Bulk\BulkListUsersResponse\Item\Status;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;
use Courier\UserRecipient;

/**
 * @phpstan-type ItemShape = array{
 *   data?: mixed,
 *   preferences?: RecipientPreferences|null,
 *   profile?: mixed,
 *   recipient?: string|null,
 *   to?: UserRecipient|null,
 *   status: value-of<Status>,
 *   messageId?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Api(optional: true)]
    public mixed $data;

    #[Api(optional: true)]
    public ?RecipientPreferences $preferences;

    #[Api(optional: true)]
    public mixed $profile;

    #[Api(nullable: true, optional: true)]
    public ?string $recipient;

    #[Api(optional: true)]
    public ?UserRecipient $to;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    #[Api(nullable: true, optional: true)]
    public ?string $messageId;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     */
    public static function with(
        Status|string $status,
        mixed $data = null,
        ?RecipientPreferences $preferences = null,
        mixed $profile = null,
        ?string $recipient = null,
        ?UserRecipient $to = null,
        ?string $messageId = null,
    ): self {
        $obj = new self;

        $obj['status'] = $status;

        null !== $data && $obj->data = $data;
        null !== $preferences && $obj->preferences = $preferences;
        null !== $profile && $obj->profile = $profile;
        null !== $recipient && $obj->recipient = $recipient;
        null !== $to && $obj->to = $to;
        null !== $messageId && $obj->messageId = $messageId;

        return $obj;
    }

    public function withData(mixed $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    public function withPreferences(RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }

    public function withProfile(mixed $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }

    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj->recipient = $recipient;

        return $obj;
    }

    public function withTo(UserRecipient $to): self
    {
        $obj = clone $this;
        $obj->to = $to;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    public function withMessageID(?string $messageID): self
    {
        $obj = clone $this;
        $obj->messageId = $messageID;

        return $obj;
    }
}
