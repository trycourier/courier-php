<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send to a Microsoft Teams address directly, bypassing the recipient's stored profile. Requires exactly one target: `channel_id`, `channel_name` (with `team_id`), `user_id`, or `email`. `channel_name`, `user_id`, and `email` also need at least one of `service_url` or `tenant_id` — if you provide both, they must agree. `channel_id` doesn't require tenant context to publish, but provide `service_url` or `tenant_id` anyway: sends without either have failed at delivery in testing. `conversation_id` and `reply_to_activity_id`, available on the send API's `MsTeams` profile, aren't supported here yet.
 *
 * @phpstan-type JourneySendNodeToMsTeamsShape = array{
 *   channelID?: string|null,
 *   channelName?: string|null,
 *   email?: string|null,
 *   serviceURL?: string|null,
 *   teamID?: string|null,
 *   tenantID?: string|null,
 *   userID?: string|null,
 * }
 */
final class JourneySendNodeToMsTeams implements BaseModel
{
    /** @use SdkModel<JourneySendNodeToMsTeamsShape> */
    use SdkModel;

    /**
     * Bot Framework channel ID to send to.
     */
    #[Optional('channel_id')]
    public ?string $channelID;

    /**
     * Teams channel name to send to. Requires `team_id`.
     */
    #[Optional('channel_name')]
    public ?string $channelName;

    /**
     * Email address of the Teams user to send to.
     */
    #[Optional]
    public ?string $email;

    /**
     * The regional Bot Framework host for this conversation, e.g. `https://smba.trafficmanager.net/amer`. A path segment naming the Microsoft tenant may follow it and is used to derive `tenant_id` when it is not supplied directly.
     */
    #[Optional('service_url')]
    public ?string $serviceURL;

    /**
     * Microsoft Teams team ID. Required alongside `channel_name`.
     */
    #[Optional('team_id')]
    public ?string $teamID;

    /**
     * The Microsoft (Azure AD) tenant this send targets or authenticates against. Unrelated to `message.context.tenant_id`, which is the Courier customer's own multi-tenant context.
     */
    #[Optional('tenant_id')]
    public ?string $tenantID;

    /**
     * Microsoft Teams user ID to send to.
     */
    #[Optional('user_id')]
    public ?string $userID;

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
        ?string $channelID = null,
        ?string $channelName = null,
        ?string $email = null,
        ?string $serviceURL = null,
        ?string $teamID = null,
        ?string $tenantID = null,
        ?string $userID = null,
    ): self {
        $self = new self;

        null !== $channelID && $self['channelID'] = $channelID;
        null !== $channelName && $self['channelName'] = $channelName;
        null !== $email && $self['email'] = $email;
        null !== $serviceURL && $self['serviceURL'] = $serviceURL;
        null !== $teamID && $self['teamID'] = $teamID;
        null !== $tenantID && $self['tenantID'] = $tenantID;
        null !== $userID && $self['userID'] = $userID;

        return $self;
    }

    /**
     * Bot Framework channel ID to send to.
     */
    public function withChannelID(string $channelID): self
    {
        $self = clone $this;
        $self['channelID'] = $channelID;

        return $self;
    }

    /**
     * Teams channel name to send to. Requires `team_id`.
     */
    public function withChannelName(string $channelName): self
    {
        $self = clone $this;
        $self['channelName'] = $channelName;

        return $self;
    }

    /**
     * Email address of the Teams user to send to.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * The regional Bot Framework host for this conversation, e.g. `https://smba.trafficmanager.net/amer`. A path segment naming the Microsoft tenant may follow it and is used to derive `tenant_id` when it is not supplied directly.
     */
    public function withServiceURL(string $serviceURL): self
    {
        $self = clone $this;
        $self['serviceURL'] = $serviceURL;

        return $self;
    }

    /**
     * Microsoft Teams team ID. Required alongside `channel_name`.
     */
    public function withTeamID(string $teamID): self
    {
        $self = clone $this;
        $self['teamID'] = $teamID;

        return $self;
    }

    /**
     * The Microsoft (Azure AD) tenant this send targets or authenticates against. Unrelated to `message.context.tenant_id`, which is the Courier customer's own multi-tenant context.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Microsoft Teams user ID to send to.
     */
    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
