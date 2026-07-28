<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\InboxRawContract;

final class InboxRawService implements InboxRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
