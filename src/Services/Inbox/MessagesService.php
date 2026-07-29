<?php

declare(strict_types=1);

namespace Courier\Services\Inbox;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Inbox\MessagesContract;

/**
 * Manage the messages in a user's in-app inbox.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class MessagesService implements MessagesContract
{
    /**
     * @api
     */
    public MessagesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new MessagesRawService($client);
    }

    /**
     * @api
     *
     * Delete a user's inbox message. The message is removed from every inbox read (it stops appearing in the recipient's Inbox); it can be restored.
     *
     * @param string $messageID the message ID of the inbox message to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Restore a previously deleted inbox message.
     *
     * @param string $messageID the message ID of the inbox message to restore
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function restore(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->restore($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
