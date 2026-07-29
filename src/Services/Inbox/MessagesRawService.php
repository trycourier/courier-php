<?php

declare(strict_types=1);

namespace Courier\Services\Inbox;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Inbox\MessagesRawContract;

/**
 * Manage the messages in a user's in-app inbox.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class MessagesRawService implements MessagesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Delete a user's inbox message. The message is removed from every inbox read (it stops appearing in the recipient's Inbox); it can be restored.
     *
     * @param string $messageID the message ID of the inbox message to delete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['inbox/messages/%1$s', $messageID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Restore a previously deleted inbox message.
     *
     * @param string $messageID the message ID of the inbox message to restore
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function restore(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['inbox/messages/%1$s/restore', $messageID],
            options: $requestOptions,
            convert: null,
        );
    }
}
