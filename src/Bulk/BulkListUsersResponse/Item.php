<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkListUsersResponse;

use Courier\Bulk\BulkListUsersResponse\Item\Status;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageContext;
use Courier\NotificationPreferenceDetails;
use Courier\RecipientPreferences;
use Courier\UserRecipient;
use Courier\UserRecipient\Preferences;

/**
 * @phpstan-type ItemShape = array{
 *   data?: mixed,
 *   preferences?: RecipientPreferences|null,
 *   profile?: mixed,
 *   recipient?: string|null,
 *   to?: UserRecipient|null,
 *   status: value-of<Status>,
 *   messageID?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    #[Optional]
    public mixed $data;

    #[Optional]
    public ?RecipientPreferences $preferences;

    #[Optional]
    public mixed $profile;

    #[Optional(nullable: true)]
    public ?string $recipient;

    #[Optional]
    public ?UserRecipient $to;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    #[Optional('messageId', nullable: true)]
    public ?string $messageID;

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
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * } $preferences
     * @param UserRecipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * } $to
     */
    public static function with(
        Status|string $status,
        mixed $data = null,
        RecipientPreferences|array|null $preferences = null,
        mixed $profile = null,
        ?string $recipient = null,
        UserRecipient|array|null $to = null,
        ?string $messageID = null,
    ): self {
        $self = new self;

        $self['status'] = $status;

        null !== $data && $self['data'] = $data;
        null !== $preferences && $self['preferences'] = $preferences;
        null !== $profile && $self['profile'] = $profile;
        null !== $recipient && $self['recipient'] = $recipient;
        null !== $to && $self['to'] = $to;
        null !== $messageID && $self['messageID'] = $messageID;

        return $self;
    }

    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param RecipientPreferences|array{
     *   categories?: array<string,NotificationPreferenceDetails>|null,
     *   notifications?: array<string,NotificationPreferenceDetails>|null,
     * } $preferences
     */
    public function withPreferences(
        RecipientPreferences|array $preferences
    ): self {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }

    public function withProfile(mixed $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * @param UserRecipient|array{
     *   accountID?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   listID?: string|null,
     *   locale?: string|null,
     *   phoneNumber?: string|null,
     *   preferences?: Preferences|null,
     *   tenantID?: string|null,
     *   userID?: string|null,
     * } $to
     */
    public function withTo(UserRecipient|array $to): self
    {
        $self = clone $this;
        $self['to'] = $to;

        return $self;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    public function withMessageID(?string $messageID): self
    {
        $self = clone $this;
        $self['messageID'] = $messageID;

        return $self;
    }
}
