<?php

namespace Courier\Send\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class BaseMessageSendTo extends JsonSerializableType
{
    /**
     * @var (
     *    AudienceRecipient
     *   |ListRecipient
     *   |ListPatternRecipient
     *   |UserRecipient
     *   |SlackRecipient
     *   |MsTeamsRecipient
     *   |array<string, mixed>
     *   |PagerdutyRecipient
     *   |WebhookRecipient
     *   |array<(
     *    AudienceRecipient
     *   |ListRecipient
     *   |ListPatternRecipient
     *   |UserRecipient
     *   |SlackRecipient
     *   |MsTeamsRecipient
     *   |array<string, mixed>
     *   |PagerdutyRecipient
     *   |WebhookRecipient
     * )>
     * )|null $to The recipient or a list of recipients of the message
     */
    #[JsonProperty('to'), Union(AudienceRecipient::class, ListRecipient::class, ListPatternRecipient::class, UserRecipient::class, SlackRecipient::class, MsTeamsRecipient::class, ['string' => 'mixed'], PagerdutyRecipient::class, WebhookRecipient::class, [new Union(AudienceRecipient::class, ListRecipient::class, ListPatternRecipient::class, UserRecipient::class, SlackRecipient::class, MsTeamsRecipient::class, ['string' => 'mixed'], PagerdutyRecipient::class, WebhookRecipient::class)], 'null')]
    public AudienceRecipient|ListRecipient|ListPatternRecipient|UserRecipient|SlackRecipient|MsTeamsRecipient|array|PagerdutyRecipient|WebhookRecipient|null $to;

    /**
     * @param array{
     *   to?: (
     *    AudienceRecipient
     *   |ListRecipient
     *   |ListPatternRecipient
     *   |UserRecipient
     *   |SlackRecipient
     *   |MsTeamsRecipient
     *   |array<string, mixed>
     *   |PagerdutyRecipient
     *   |WebhookRecipient
     *   |array<(
     *    AudienceRecipient
     *   |ListRecipient
     *   |ListPatternRecipient
     *   |UserRecipient
     *   |SlackRecipient
     *   |MsTeamsRecipient
     *   |array<string, mixed>
     *   |PagerdutyRecipient
     *   |WebhookRecipient
     * )>
     * )|null,
     * } $values
     */
    public function __construct(
        array $values = [],
    ) {
        $this->to = $values['to'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
