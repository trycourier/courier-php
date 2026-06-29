<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Journeys\CancelJourneyRequest\ByCancelationToken;
use Courier\Journeys\CancelJourneyRequest\ByRunID;

/**
 * Request body for `POST /journeys/cancel`. Provide EXACTLY ONE of `cancelation_token` (cancels every run associated with the token) or `run_id` (cancels a single tenant-scoped run).
 *
 * @phpstan-import-type ByCancelationTokenShape from \Courier\Journeys\CancelJourneyRequest\ByCancelationToken
 * @phpstan-import-type ByRunIDShape from \Courier\Journeys\CancelJourneyRequest\ByRunID
 *
 * @phpstan-type CancelJourneyRequestVariants = ByCancelationToken|ByRunID
 * @phpstan-type CancelJourneyRequestShape = CancelJourneyRequestVariants|ByCancelationTokenShape|ByRunIDShape
 */
final class CancelJourneyRequest implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [ByCancelationToken::class, ByRunID::class];
    }
}
