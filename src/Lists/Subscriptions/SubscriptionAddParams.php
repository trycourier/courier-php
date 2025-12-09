<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Lists\PutSubscriptionsRecipient;
use Courier\RecipientPreferences;

/**
 * Subscribes additional users to the list, without modifying existing subscriptions. If the list does not exist, it will be automatically created.
 *
 * @see Courier\Services\Lists\SubscriptionsService::add()
 *
 * @phpstan-type SubscriptionAddParamsShape = array{
 *   recipients: list<PutSubscriptionsRecipient|array{
 *     recipientId: string, preferences?: RecipientPreferences|null
 *   }>,
 * }
 */
final class SubscriptionAddParams implements BaseModel
{
    /** @use SdkModel<SubscriptionAddParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<PutSubscriptionsRecipient> $recipients */
    #[Required(list: PutSubscriptionsRecipient::class)]
    public array $recipients;

    /**
     * `new SubscriptionAddParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionAddParams::with(recipients: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionAddParams)->withRecipients(...)
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
     * @param list<PutSubscriptionsRecipient|array{
     *   recipientId: string, preferences?: RecipientPreferences|null
     * }> $recipients
     */
    public static function with(array $recipients): self
    {
        $obj = new self;

        $obj['recipients'] = $recipients;

        return $obj;
    }

    /**
     * @param list<PutSubscriptionsRecipient|array{
     *   recipientId: string, preferences?: RecipientPreferences|null
     * }> $recipients
     */
    public function withRecipients(array $recipients): self
    {
        $obj = clone $this;
        $obj['recipients'] = $recipients;

        return $obj;
    }
}
