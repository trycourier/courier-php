<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type put_subscriptions_recipient = array{
 *   recipientID: string, preferences?: RecipientPreferences|null
 * }
 */
final class PutSubscriptionsRecipient implements BaseModel
{
    /** @use SdkModel<put_subscriptions_recipient> */
    use SdkModel;

    #[Api('recipientId')]
    public string $recipientID;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new PutSubscriptionsRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PutSubscriptionsRecipient::with(recipientID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PutSubscriptionsRecipient)->withRecipientID(...)
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
        ?RecipientPreferences $preferences = null
    ): self {
        $obj = new self;

        $obj->recipientID = $recipientID;

        null !== $preferences && $obj->preferences = $preferences;

        return $obj;
    }

    public function withRecipientID(string $recipientID): self
    {
        $obj = clone $this;
        $obj->recipientID = $recipientID;

        return $obj;
    }

    public function withPreferences(?RecipientPreferences $preferences): self
    {
        $obj = clone $this;
        $obj->preferences = $preferences;

        return $obj;
    }
}
