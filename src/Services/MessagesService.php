<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Messages\MessageContentResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryParams;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListParams;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\MessagesContract;

final class MessagesService implements MessagesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Fetch the status of a message you've previously sent.
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageGetResponse {
        /** @var BaseResponse<MessageGetResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['messages/%1$s', $messageID],
            options: $requestOptions,
            convert: MessageGetResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch the statuses of messages you've previously sent.
     *
     * @param array{
     *   archived?: bool|null,
     *   cursor?: string|null,
     *   enqueued_after?: string|null,
     *   event?: string|null,
     *   list?: string|null,
     *   messageId?: string|null,
     *   notification?: string|null,
     *   provider?: list<string|null>,
     *   recipient?: string|null,
     *   status?: list<string|null>,
     *   tag?: list<string|null>,
     *   tags?: string|null,
     *   tenant_id?: string|null,
     *   traceId?: string|null,
     * }|MessageListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|MessageListParams $params,
        ?RequestOptions $requestOptions = null
    ): MessageListResponse {
        [$parsed, $options] = MessageListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<MessageListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'messages',
            query: $parsed,
            options: $options,
            convert: MessageListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a message that is currently in the process of being delivered. A well-formatted API call to the cancel message API will return either `200` status code for a successful cancellation or `409` status code for an unsuccessful cancellation. Both cases will include the actual message record in the response body (see details below).
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageDetails {
        /** @var BaseResponse<MessageDetails> */
        $response = $this->client->request(
            method: 'post',
            path: ['messages/%1$s/cancel', $messageID],
            options: $requestOptions,
            convert: MessageDetails::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get message content
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageContentResponse {
        /** @var BaseResponse<MessageContentResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['messages/%1$s/output', $messageID],
            options: $requestOptions,
            convert: MessageContentResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch the array of events of a message you've previously sent.
     *
     * @param array{type?: string|null}|MessageHistoryParams $params
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        array|MessageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): MessageHistoryResponse {
        [$parsed, $options] = MessageHistoryParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<MessageHistoryResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['messages/%1$s/history', $messageID],
            query: $parsed,
            options: $options,
            convert: MessageHistoryResponse::class,
        );

        return $response->parse();
    }
}
