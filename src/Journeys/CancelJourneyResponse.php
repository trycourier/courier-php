<?php

declare(strict_types=1);

namespace Courier\Journeys;

use Courier\Core\Concerns\SdkUnion;
use Courier\Core\Conversion\Contracts\Converter;
use Courier\Core\Conversion\Contracts\ConverterSource;
use Courier\Journeys\CancelJourneyResponse\RunIDBranch;
use Courier\Journeys\CancelJourneyResponse\TokenBranch;

/**
 * `202 Accepted` body for `POST /journeys/cancel`, returning the submitted identifier. When called with `cancelation_token`, returns `{ cancelation_token }`; when called with `run_id`, returns `{ run_id, status }`.
 *
 * @phpstan-import-type TokenBranchShape from \Courier\Journeys\CancelJourneyResponse\TokenBranch
 * @phpstan-import-type RunIDBranchShape from \Courier\Journeys\CancelJourneyResponse\RunIDBranch
 *
 * @phpstan-type CancelJourneyResponseVariants = TokenBranch|RunIDBranch
 * @phpstan-type CancelJourneyResponseShape = CancelJourneyResponseVariants|TokenBranchShape|RunIDBranchShape
 */
final class CancelJourneyResponse implements ConverterSource
{
    use SdkUnion;

    /**
     * @return list<string|Converter|ConverterSource>|array<string,string|Converter|ConverterSource>
     */
    public static function variants(): array
    {
        return [TokenBranch::class, RunIDBranch::class];
    }
}
