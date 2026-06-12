<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\DigestsContract;
use Courier\Services\Digests\SchedulesService;

final class DigestsService implements DigestsContract
{
    /**
     * @api
     */
    public DigestsRawService $raw;

    /**
     * @api
     */
    public SchedulesService $schedules;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new DigestsRawService($client);
        $this->schedules = new SchedulesService($client);
    }
}
