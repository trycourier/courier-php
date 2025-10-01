<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo;

use Courier\Bulk\UserRecipient;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\ListOf;
use Courier\Core\Conversion\MapOf;
use Courier\Send\BaseMessageSendTo\To\AudienceRecipient;
use Courier\Send\BaseMessageSendTo\To\MsTeamsRecipient;
use Courier\Send\BaseMessageSendTo\To\PagerdutyRecipient;
use Courier\Send\BaseMessageSendTo\To\SlackRecipient;
use Courier\Send\BaseMessageSendTo\To\UnionMember1;
use Courier\Send\BaseMessageSendTo\To\UnionMember2;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient;
use Courier\Send\Recipient;

/**
 * The recipient or a list of recipients of the message.
 */
final class To implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            AudienceRecipient::class,
            UnionMember1::class,
            UnionMember2::class,
            UserRecipient::class,
            SlackRecipient::class,
            MsTeamsRecipient::class,
            new MapOf('mixed'),
            PagerdutyRecipient::class,
            WebhookRecipient::class,
            new ListOf(Recipient::class),
        ];
    }
}
