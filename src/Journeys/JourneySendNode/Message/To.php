<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Journeys\JourneySendNodeToMsTeams;
use Courier\Journeys\JourneySendNodeToSlackChannel;
use Courier\Journeys\JourneySendNodeToSlackEmail;
use Courier\Journeys\JourneySendNodeToSlackUserID;

/**
 * Recipient override for this send. Provide exactly one of `email_override`, `phone_number_override`, `user_id_override`, `slack`, or `ms_teams` — not a combination.
 *
 * @phpstan-import-type JourneySendNodeToSlackVariants from \Courier\Journeys\JourneySendNodeToSlack
 * @phpstan-import-type JourneySendNodeToMsTeamsShape from \Courier\Journeys\JourneySendNodeToMsTeams
 * @phpstan-import-type JourneySendNodeToSlackShape from \Courier\Journeys\JourneySendNodeToSlack
 *
 * @phpstan-type ToShape = array{
 *   emailOverride?: string|null,
 *   msTeams?: null|JourneySendNodeToMsTeams|JourneySendNodeToMsTeamsShape,
 *   phoneNumberOverride?: string|null,
 *   slack?: JourneySendNodeToSlackShape|null,
 *   userIDOverride?: string|null,
 * }
 */
final class To implements BaseModel
{
    /** @use SdkModel<ToShape> */
    use SdkModel;

    #[Optional('email_override')]
    public ?string $emailOverride;

    /**
     * Send to a Microsoft Teams address directly, bypassing the recipient's stored profile. Requires exactly one target: `channel_id`, `channel_name` (with `team_id`), `user_id`, or `email`. `channel_name`, `user_id`, and `email` also need at least one of `service_url` or `tenant_id` — if you provide both, they must agree. `channel_id` doesn't require tenant context to publish, but provide `service_url` or `tenant_id` anyway: sends without either have failed at delivery in testing. `conversation_id` and `reply_to_activity_id`, available on the send API's `MsTeams` profile, aren't supported here yet.
     */
    #[Optional('ms_teams')]
    public ?JourneySendNodeToMsTeams $msTeams;

    #[Optional('phone_number_override')]
    public ?string $phoneNumberOverride;

    /**
     * Send to a Slack address directly, bypassing the recipient's stored profile. Requires exactly one of `channel`, `user_id`, or `email`.
     *
     * @var JourneySendNodeToSlackVariants|null $slack
     */
    #[Optional]
    public JourneySendNodeToSlackChannel|JourneySendNodeToSlackUserID|JourneySendNodeToSlackEmail|null $slack;

    #[Optional('user_id_override')]
    public ?string $userIDOverride;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param JourneySendNodeToMsTeams|JourneySendNodeToMsTeamsShape|null $msTeams
     * @param JourneySendNodeToSlackShape|null $slack
     */
    public static function with(
        ?string $emailOverride = null,
        JourneySendNodeToMsTeams|array|null $msTeams = null,
        ?string $phoneNumberOverride = null,
        JourneySendNodeToSlackChannel|array|JourneySendNodeToSlackUserID|JourneySendNodeToSlackEmail|null $slack = null,
        ?string $userIDOverride = null,
    ): self {
        $self = new self;

        null !== $emailOverride && $self['emailOverride'] = $emailOverride;
        null !== $msTeams && $self['msTeams'] = $msTeams;
        null !== $phoneNumberOverride && $self['phoneNumberOverride'] = $phoneNumberOverride;
        null !== $slack && $self['slack'] = $slack;
        null !== $userIDOverride && $self['userIDOverride'] = $userIDOverride;

        return $self;
    }

    public function withEmailOverride(string $emailOverride): self
    {
        $self = clone $this;
        $self['emailOverride'] = $emailOverride;

        return $self;
    }

    /**
     * Send to a Microsoft Teams address directly, bypassing the recipient's stored profile. Requires exactly one target: `channel_id`, `channel_name` (with `team_id`), `user_id`, or `email`. `channel_name`, `user_id`, and `email` also need at least one of `service_url` or `tenant_id` — if you provide both, they must agree. `channel_id` doesn't require tenant context to publish, but provide `service_url` or `tenant_id` anyway: sends without either have failed at delivery in testing. `conversation_id` and `reply_to_activity_id`, available on the send API's `MsTeams` profile, aren't supported here yet.
     *
     * @param JourneySendNodeToMsTeams|JourneySendNodeToMsTeamsShape $msTeams
     */
    public function withMsTeams(JourneySendNodeToMsTeams|array $msTeams): self
    {
        $self = clone $this;
        $self['msTeams'] = $msTeams;

        return $self;
    }

    public function withPhoneNumberOverride(string $phoneNumberOverride): self
    {
        $self = clone $this;
        $self['phoneNumberOverride'] = $phoneNumberOverride;

        return $self;
    }

    /**
     * Send to a Slack address directly, bypassing the recipient's stored profile. Requires exactly one of `channel`, `user_id`, or `email`.
     *
     * @param JourneySendNodeToSlackShape $slack
     */
    public function withSlack(
        JourneySendNodeToSlackChannel|array|JourneySendNodeToSlackUserID|JourneySendNodeToSlackEmail $slack,
    ): self {
        $self = clone $this;
        $self['slack'] = $slack;

        return $self;
    }

    public function withUserIDOverride(string $userIDOverride): self
    {
        $self = clone $this;
        $self['userIDOverride'] = $userIDOverride;

        return $self;
    }
}
