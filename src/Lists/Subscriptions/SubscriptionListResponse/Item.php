<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions\SubscriptionListResponse;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;

/**
 * @phpstan-type ItemShape = array{
 *   recipientID: string,
 *   created?: string|null,
 *   preferences?: RecipientPreferences|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Api('recipientId')]
    public string $recipientID;

    #[Api(nullable: true, optional: true)]
    public ?string $created;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new Item()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Item::with(recipientID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Item)->withRecipientID(...)
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
        string $recipientID,
        ?string $created = null,
        ?RecipientPreferences $preferences = null,
    ): self {
        $obj = new self;

        $obj->recipientID = $recipientID;

        null !== $created && $obj->created = $created;
        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withRecipientID(string $recipientID): self
    {
        $obj = clone $this;
        $obj->recipientID = $recipientID;

        return $obj;
    }

    public function withCreated(?string $created): self
    {
        $obj = clone $this;
        $obj->created = $created;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
