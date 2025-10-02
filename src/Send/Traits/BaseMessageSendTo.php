<?php

namespace Courier\Send\Traits;

use Courier\Send\Types\AudienceRecipient;
use Courier\Send\Types\ListRecipient;
use Courier\Send\Types\ListPatternRecipient;
use Courier\Send\Types\UserRecipient;
use Courier\Send\Types\SlackRecipient;
use Courier\Send\Types\MsTeamsRecipient;
use Courier\Send\Types\PagerdutyRecipient;
use Courier\Send\Types\WebhookRecipient;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

/**
 * @property (
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
 * )|null $to
 */
trait BaseMessageSendTo
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
}
