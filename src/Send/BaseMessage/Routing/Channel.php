<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessage\Routing;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyChannel;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyProvider;

final class Channel implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,
     * string|Converter|ConverterSource,>
     */
    public static function variants(): array
    {
        return [
            RoutingStrategyChannel::class, RoutingStrategyProvider::class, 'string',
        ];
    }
}
