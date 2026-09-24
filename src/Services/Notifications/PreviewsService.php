<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\ServiceContracts\Notifications\PreviewsContract;
use Courier\Services\Notifications\Previews\RunsService;

final class PreviewsService implements PreviewsContract
{
    /**
     * @api
     */
    public PreviewsRawService $raw;

    /**
     * @api
     */
    public RunsService $runs;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PreviewsRawService($client);
        $this->runs = new RunsService($client);
    }
}
