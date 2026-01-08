<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

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
 * The recipient or a list of recipients of the message.
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
 * @phpstan-type ToVariants = UserRecipient|AudienceRecipient|ListRecipient|ListPatternRecipient|SlackRecipient|MsTeamsRecipient|PagerdutyRecipient|WebhookRecipient
 * @phpstan-type ToShape = ToVariants|UserRecipientShape|AudienceRecipientShape|ListRecipientShape|ListPatternRecipientShape|SlackRecipientShape|MsTeamsRecipientShape|PagerdutyRecipientShape|WebhookRecipientShape
 */
final class To implements ConverterSource
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
