<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\MessageContext;
use Courier\NotificationPreferenceDetails;
use Courier\ProfilePreferences;
use Courier\RecipientPreferences;
use Courier\UserRecipient;

/**
 * @phpstan-type InboundBulkMessageUserShape = array{
 *   data?: mixed,
 *   preferences?: RecipientPreferences|null,
 *   profile?: mixed,
 *   recipient?: string|null,
 *   to?: UserRecipient|null,
 * }
 */
final class InboundBulkMessageUser implements BaseModel
{
    /** @use SdkModel<InboundBulkMessageUserShape> */
    use SdkModel;

    #[Api(optional: true)]
    public mixed $data;

    #[Api(nullable: true, optional: true)]
    public ?RecipientPreferences $preferences;

    #[Api(optional: true)]
    public mixed $profile;

    #[Api(nullable: true, optional: true)]
    public ?string $recipient;

    #[Api(nullable: true, optional: true)]
    public ?UserRecipient $to;

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
     * @param UserRecipient|array{
     *   account_id?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   list_id?: string|null,
     *   locale?: string|null,
     *   phone_number?: string|null,
     *   preferences?: ProfilePreferences|null,
     *   tenant_id?: string|null,
     *   user_id?: string|null,
     * }|null $to
     */
    public static function with(
        mixed $data = null,
        RecipientPreferences|array|null $preferences = null,
        mixed $profile = null,
        ?string $recipient = null,
        UserRecipient|array|null $to = null,
    ): self {
        $obj = new self;

        null !== $data && $obj['data'] = $data;
        null !== $preferences && $obj['preferences'] = $preferences;
        null !== $profile && $obj['profile'] = $profile;
        null !== $recipient && $obj['recipient'] = $recipient;
        null !== $to && $obj['to'] = $to;

        return $obj;
    }

    public function withData(mixed $data): self
    {
        $obj = clone $this;
        $obj['data'] = $data;

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

    public function withProfile(mixed $profile): self
    {
        $obj = clone $this;
        $obj['profile'] = $profile;

        return $obj;
    }

    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj['recipient'] = $recipient;

        return $obj;
    }

    /**
     * @param UserRecipient|array{
     *   account_id?: string|null,
     *   context?: MessageContext|null,
     *   data?: array<string,mixed>|null,
     *   email?: string|null,
     *   list_id?: string|null,
     *   locale?: string|null,
     *   phone_number?: string|null,
     *   preferences?: ProfilePreferences|null,
     *   tenant_id?: string|null,
     *   user_id?: string|null,
     * }|null $to
     */
    public function withTo(UserRecipient|array|null $to): self
    {
        $obj = clone $this;
        $obj['to'] = $to;

        return $obj;
    }
}
