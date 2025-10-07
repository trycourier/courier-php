<?php

declare(strict_types=1);

namespace Courier\Send\SendSendMessageParams\Message;

use Courier\Bulk\UserRecipient;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\ListOf;
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
        return [UserRecipient::class, new ListOf(Recipient::class)];
    }
}
