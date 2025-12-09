<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\AutomationsRawContract;

final class AutomationsRawService implements AutomationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
