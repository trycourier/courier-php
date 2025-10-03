<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Bulk\UserRecipient;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To;
use Courier\Send\BaseMessageSendTo\To\AudienceRecipient;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient;
use Courier\Send\BaseMessageSendTo\To\PagerdutyRecipient;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient;
use Courier\Send\BaseMessageSendTo\To\UnionMember1;
use Courier\Send\BaseMessageSendTo\To\UnionMember2;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient;

/**
 * @phpstan-type base_message_send_to = array{
 *   to?: null|AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<Courier\Send\Recipient\AudienceRecipient|Courier\Send\Recipient\UnionMember1|Courier\Send\Recipient\UnionMember2|UserRecipient|Courier\Send\Recipient\SlackRecipient|Courier\Send\Recipient\MsTeamsRecipient|Courier\Send\Recipient\PagerdutyRecipient|Courier\Send\Recipient\WebhookRecipient|array<string,
 *   mixed,>>|array<string, mixed>,
 * }
 */
final class BaseMessageSendTo implements BaseModel
{
    /** @use SdkModel<base_message_send_to> */
    use SdkModel;

    /**
     * The recipient or a list of recipients of the message.
     *
     * @var AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<Courier\Send\Recipient\AudienceRecipient|Courier\Send\Recipient\UnionMember1|Courier\Send\Recipient\UnionMember2|UserRecipient|Courier\Send\Recipient\SlackRecipient|Courier\Send\Recipient\MsTeamsRecipient|Courier\Send\Recipient\PagerdutyRecipient|Courier\Send\Recipient\WebhookRecipient|array<string,
     * mixed,>>|array<string, mixed>|null $to
     */
    #[Api(union: To::class, nullable: true, optional: true)]
    public AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|array|null $to;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<Courier\Send\Recipient\AudienceRecipient|Courier\Send\Recipient\UnionMember1|Courier\Send\Recipient\UnionMember2|UserRecipient|Courier\Send\Recipient\SlackRecipient|Courier\Send\Recipient\MsTeamsRecipient|Courier\Send\Recipient\PagerdutyRecipient|Courier\Send\Recipient\WebhookRecipient|array<string,
     * mixed,>>|array<string, mixed>|null $to
     */
    public static function with(
        AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|array|null $to = null,
    ): self {
        $obj = new self;

        null !== $to && $obj->to = $to;

        return $obj;
    }

    /**
     * The recipient or a list of recipients of the message.
     *
     * @param AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|list<Courier\Send\Recipient\AudienceRecipient|Courier\Send\Recipient\UnionMember1|Courier\Send\Recipient\UnionMember2|UserRecipient|Courier\Send\Recipient\SlackRecipient|Courier\Send\Recipient\MsTeamsRecipient|Courier\Send\Recipient\PagerdutyRecipient|Courier\Send\Recipient\WebhookRecipient|array<string,
     * mixed,>>|array<string, mixed>|null $to
     */
    public function withTo(
        AudienceRecipient|UnionMember1|UnionMember2|UserRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient|array|null $to,
    ): self {
        $obj = clone $this;
        $obj->to = $to;

        return $obj;
    }
}
