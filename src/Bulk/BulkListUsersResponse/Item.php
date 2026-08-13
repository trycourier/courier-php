<?php

declare(strict_types=1);

namespace Courier\Bulk\BulkListUsersResponse;

use Courier\Bulk\BulkListUsersResponse\Item\Status;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;
use Courier\UserRecipient;

/**
 * @phpstan-import-type RecipientPreferencesShape from \Courier\RecipientPreferences
 * @phpstan-import-type UserRecipientShape from \Courier\UserRecipient
 *
 * @phpstan-type ItemShape = array{
 *   data?: mixed,
 *   preferences?: null|RecipientPreferences|RecipientPreferencesShape,
 *   profile?: array<string,mixed>|null,
 *   recipient?: string|null,
 *   to?: null|UserRecipient|UserRecipientShape,
 *   status: Status|value-of<Status>,
 *   messageID?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * User-specific data that will be merged with message.data.
     */
    #[Optional]
    public mixed $data;

    #[Optional]
    public ?RecipientPreferences $preferences;

    /**
     * User profile information. For email-based bulk jobs, `profile.email` is required
     * for provider routing to determine if the message can be delivered. The email
     * address should be provided here rather than in `to.email`.
     *
     * @var array<string,mixed>|null $profile
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $profile;

    /**
     * User ID (legacy field, use profile or to.user_id instead).
     */
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
     * @param RecipientPreferences|RecipientPreferencesShape|null $preferences
     * @param array<string,mixed>|null $profile
     * @param UserRecipient|UserRecipientShape|null $to
     */
    public static function with(
        Status|string $status,
        mixed $data = null,
        RecipientPreferences|array|null $preferences = null,
        ?array $profile = null,
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

    /**
     * User-specific data that will be merged with message.data.
     */
    public function withData(mixed $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param RecipientPreferences|RecipientPreferencesShape $preferences
     */
    public function withPreferences(
        RecipientPreferences|array $preferences
    ): self {
        $self = clone $this;
        $self['preferences'] = $preferences;

        return $self;
    }

    /**
     * User profile information. For email-based bulk jobs, `profile.email` is required
     * for provider routing to determine if the message can be delivered. The email
     * address should be provided here rather than in `to.email`.
     *
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * User ID (legacy field, use profile or to.user_id instead).
     */
    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    /**
     * @param UserRecipient|UserRecipientShape $to
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
