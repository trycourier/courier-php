<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send via Microsoft Teams.
 *
 * @phpstan-import-type MsTeamsVariants from \Courier\MsTeams
 * @phpstan-import-type MsTeamsShape from \Courier\MsTeams
 *
 * @phpstan-type MsTeamsRecipientShape = array{msTeams: MsTeamsShape}
 */
final class MsTeamsRecipient implements BaseModel
{
    /** @use SdkModel<MsTeamsRecipientShape> */
    use SdkModel;

    /** @var MsTeamsVariants $msTeams */
    #[Required('ms_teams')]
    public SendToMsTeamsUserID|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName $msTeams;

    /**
     * `new MsTeamsRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MsTeamsRecipient::with(msTeams: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MsTeamsRecipient)->withMsTeams(...)
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
     * @param MsTeamsShape $msTeams
     */
    public static function with(
        SendToMsTeamsUserID|array|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName $msTeams,
    ): self {
        $self = new self;

        $self['msTeams'] = $msTeams;

        return $self;
    }

    /**
     * @param MsTeamsShape $msTeams
     */
    public function withMsTeams(
        SendToMsTeamsUserID|array|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName $msTeams,
    ): self {
        $self = clone $this;
        $self['msTeams'] = $msTeams;

        return $self;
    }
}
