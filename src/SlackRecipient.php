<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Send via Slack (channel, email, or user_id).
 *
 * @phpstan-import-type SlackVariants from \Courier\Slack
 * @phpstan-import-type SlackShape from \Courier\Slack
 *
 * @phpstan-type SlackRecipientShape = array{slack: SlackShape}
 */
final class SlackRecipient implements BaseModel
{
    /** @use SdkModel<SlackRecipientShape> */
    use SdkModel;

    /** @var SlackVariants $slack */
    #[Required]
    public SendToSlackChannel|SendToSlackEmail|SendToSlackUserID $slack;

    /**
     * `new SlackRecipient()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SlackRecipient::with(slack: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SlackRecipient)->withSlack(...)
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
     * @param SlackShape $slack
     */
    public static function with(
        SendToSlackChannel|array|SendToSlackEmail|SendToSlackUserID $slack
    ): self {
        $self = new self;

        $self['slack'] = $slack;

        return $self;
    }

    /**
     * @param SlackShape $slack
     */
    public function withSlack(
        SendToSlackChannel|array|SendToSlackEmail|SendToSlackUserID $slack
    ): self {
        $self = clone $this;
        $self['slack'] = $slack;

        return $self;
    }
}
