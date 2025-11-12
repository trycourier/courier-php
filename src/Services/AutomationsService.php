<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\AutomationsContract;
use Courier\Services\Automations\InvokeService;

final class AutomationsService implements AutomationsContract
{
    /**
     * @api
     */
    public InvokeService $invoke;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->invoke = new InvokeService($client);
    }
}
