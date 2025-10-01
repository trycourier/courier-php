<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Bulk\UserRecipient;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\MapOf;
use Courier\Send\Recipient\AudienceRecipient;
use Courier\Send\Recipient\MsTeamsRecipient;
use Courier\Send\Recipient\PagerdutyRecipient;
use Courier\Send\Recipient\SlackRecipient;
use Courier\Send\Recipient\UnionMember1;
use Courier\Send\Recipient\UnionMember2;
use Courier\Send\Recipient\WebhookRecipient;

final class Recipient implements ConverterSource
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
        ];
    }
}
