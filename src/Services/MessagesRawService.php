<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Messages\MessageContentResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryParams;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListParams;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\MessagesRawContract;

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
     * Fetch the status of a message you've previously sent.
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     *
     * @return BaseResponse<MessageGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['messages/%1$s', $messageID],
            options: $requestOptions,
            convert: MessageGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Fetch the statuses of messages you've previously sent.
     *
     * @param array{
     *   archived?: bool|null,
     *   cursor?: string|null,
     *   enqueuedAfter?: string|null,
     *   event?: string|null,
     *   list?: string|null,
     *   messageID?: string|null,
     *   notification?: string|null,
     *   provider?: list<string|null>,
     *   recipient?: string|null,
     *   status?: list<string|null>,
     *   tag?: list<string|null>,
     *   tags?: string|null,
     *   tenantID?: string|null,
     *   traceID?: string|null,
     * }|MessageListParams $params
     *
     * @return BaseResponse<MessageListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|MessageListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        [$parsed, $options] = MessageListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'messages',
            query: Util::array_transform_keys(
                $parsed,
                [
                    'enqueuedAfter' => 'enqueued_after',
                    'messageID' => 'messageId',
                    'tenantID' => 'tenant_id',
                    'traceID' => 'traceId',
                ],
            ),
            options: $options,
            convert: MessageListResponse::class,
        );
    }

    /**
     * @api
     *
     * Cancel a message that is currently in the process of being delivered. A well-formatted API call to the cancel message API will return either `200` status code for a successful cancellation or `409` status code for an unsuccessful cancellation. Both cases will include the actual message record in the response body (see details below).
     *
     * @param string $messageID A unique identifier representing the message ID
     *
     * @return BaseResponse<MessageDetails>
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['messages/%1$s/cancel', $messageID],
            options: $requestOptions,
            convert: MessageDetails::class,
        );
    }

    /**
     * @api
     *
     * Get message content
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     *
     * @return BaseResponse<MessageContentResponse>
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['messages/%1$s/output', $messageID],
            options: $requestOptions,
            convert: MessageContentResponse::class,
        );
    }

    /**
     * @api
     *
     * Fetch the array of events of a message you've previously sent.
     *
     * @param string $messageID A unique identifier representing the message ID
     * @param array{type?: string|null}|MessageHistoryParams $params
     *
     * @return BaseResponse<MessageHistoryResponse>
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        array|MessageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = MessageHistoryParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['messages/%1$s/history', $messageID],
            query: $parsed,
            options: $options,
            convert: MessageHistoryResponse::class,
        );
    }
}
