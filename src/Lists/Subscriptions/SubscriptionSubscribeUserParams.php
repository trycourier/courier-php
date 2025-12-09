<?php

declare(strict_types=1);

namespace Courier\Lists\Subscriptions;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;

/**
 * Subscribe a user to an existing list (note: if the List does not exist, it will be automatically created).
 *
 * @see Courier\Services\Lists\SubscriptionsService::subscribeUser()
 *
 * @phpstan-type SubscriptionSubscribeUserParamsShape = array{
 *   listID: string,
 *   preferences?: null|RecipientPreferences|array{
 *     categories?: array<string,NotificationPreferenceDetails>|null,
 *     notifications?: array<string,NotificationPreferenceDetails>|null,
 *   },
 * }
 */
final class SubscriptionSubscribeUserParams implements BaseModel
{
    /** @use SdkModel<SubscriptionSubscribeUserParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $listID;

    #[Optional(nullable: true)]
    public ?RecipientPreferences $preferences;

    /**
     * `new SubscriptionSubscribeUserParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SubscriptionSubscribeUserParams::with(listID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SubscriptionSubscribeUserParams)->withListID(...)
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
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * }|null $preferences
     */
    public static function with(
        string $listID,
        RecipientPreferences|array|null $preferences = null
    ): self {
        $obj = new self;

        $obj['listID'] = $listID;

        null !== $preferences && $obj['preferences'] = $preferences;

        return $obj;
    }

    public function withListID(string $listID): self
    {
        $obj = clone $this;
        $obj['listID'] = $listID;

        return $obj;
    }

    /**
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * }|null $preferences
     */
    public function withPreferences(
        RecipientPreferences|array|null $preferences
    ): self {
        $obj = clone $this;
        $obj['preferences'] = $preferences;

        return $obj;
    }
}
