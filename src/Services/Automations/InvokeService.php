<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Client;
use Courier\ServiceContracts\Automations\InvokeContract;

final class InvokeService implements InvokeContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}
}
