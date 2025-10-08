<?php

declare(strict_types=1);

namespace Courier\Send;

use Courier\Bulk\UserRecipient;
use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\Recipient\ListRecipient;

final class Recipient implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [UserRecipient::class, ListRecipient::class];
    }
}
