<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message\To;

use Courier\AudienceRecipient;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\ListPatternRecipient;
use Courier\ListRecipient;
use Courier\MsTeamsRecipient;
use Courier\PagerdutyRecipient;
use Courier\SlackRecipient;
use Courier\UserRecipient;
use Courier\WebhookRecipient;

/**
 * A single recipient of the message. Choose one of the following types based on how you want to identify the recipient: - **User**: Send to a specific user by user_id, email, or phone number - **Audience**: Send to all users in an audience - **List**: Send to all users in a list - **List Pattern**: Send to users in lists matching a pattern - **Slack**: Send via Slack (channel, email, or user_id) - **MS Teams**: Send via Microsoft Teams - **PagerDuty**: Send via PagerDuty - **Webhook**: Send via webhook.
 *
 * @phpstan-import-type UserRecipientShape from \Courier\UserRecipient
 * @phpstan-import-type AudienceRecipientShape from \Courier\AudienceRecipient
 * @phpstan-import-type ListRecipientShape from \Courier\ListRecipient
 * @phpstan-import-type ListPatternRecipientShape from \Courier\ListPatternRecipient
 * @phpstan-import-type SlackRecipientShape from \Courier\SlackRecipient
 * @phpstan-import-type MsTeamsRecipientShape from \Courier\MsTeamsRecipient
 * @phpstan-import-type PagerdutyRecipientShape from \Courier\PagerdutyRecipient
 * @phpstan-import-type WebhookRecipientShape from \Courier\WebhookRecipient
 *
 * @phpstan-type UnionMember8Variants = UserRecipient|AudienceRecipient|ListRecipient|ListPatternRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient
 * @phpstan-type UnionMember8Shape = UnionMember8Variants|UserRecipientShape|AudienceRecipientShape|ListRecipientShape|ListPatternRecipientShape|SlackRecipientShape|MsTeamsRecipientShape|PagerdutyRecipientShape|WebhookRecipientShape
 */
final class UnionMember8 implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [
            UserRecipient::class,
            AudienceRecipient::class,
            ListRecipient::class,
            ListPatternRecipient::class,
            SlackRecipient::class,
            MsTeamsRecipient::class,
            PagerdutyRecipient::class,
            WebhookRecipient::class,
        ];
    }
}
