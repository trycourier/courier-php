<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\DigestsRawContract;

final class DigestsRawService implements DigestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
