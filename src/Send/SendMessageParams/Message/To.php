<?php

declare(strict_types=1);

namespace Courier\Send\SendMessageParams\Message;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Core\Conversion\ListOf;
use Courier\Recipient;
use Courier\UserRecipient;

/**
 * The recipient or a list of recipients of the message.
 *
 * @phpstan-import-type UserRecipientShape from \Courier\UserRecipient
 * @phpstan-import-type RecipientShape from \Courier\Recipient
 *
 * @phpstan-type ToShape = UserRecipientShape|list<RecipientShape>
 */
final class To implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [UserRecipient::class, new ListOf(Recipient::class)];
    }
}
