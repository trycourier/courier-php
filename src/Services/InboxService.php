<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\ServiceContracts\InboxContract;
use Courier\Services\Inbox\MessagesService;

final class InboxService implements InboxContract
{
    /**
     * @api
     */
    public InboxRawService $raw;

    /**
     * @api
     */
    public MessagesService $messages;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new InboxRawService($client);
        $this->messages = new MessagesService($client);
    }
}
