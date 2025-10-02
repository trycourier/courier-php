<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Messages\MessageContentResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryParams;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListParams;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\MessagesContract;

use const Courier\Core\OMIT as omit;

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
     * @return MessageGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageGetResponse {
        $params = [];

        return $this->retrieveRaw($messageID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return MessageGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $messageID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): MessageGetResponse {
        // @phpstan-ignore-next-line;
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
     * @param bool|null $archived a boolean value that indicates whether archived messages should be included in the response
     * @param string|null $cursor a unique identifier that allows for fetching the next set of messages
     * @param string|null $enqueuedAfter the enqueued datetime of a message to filter out messages received before
     * @param string|null $event a unique identifier representing the event that was used to send the event
     * @param string|null $list a unique identifier representing the list the message was sent to
     * @param string|null $messageID a unique identifier representing the message_id returned from either /send or /send/list
     * @param string|null $notification a unique identifier representing the notification that was used to send the event
     * @param list<string> $provider The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     * @param string|null $recipient a unique identifier representing the recipient associated with the requested profile
     * @param list<string> $status An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     * @param list<string> $tag A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     * @param string|null $tags A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     * @param string|null $tenantID Messages sent with the context of a Tenant
     * @param string|null $traceID The unique identifier used to trace the requests
     *
     * @return MessageListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        $archived = omit,
        $cursor = omit,
        $enqueuedAfter = omit,
        $event = omit,
        $list = omit,
        $messageID = omit,
        $notification = omit,
        $provider = omit,
        $recipient = omit,
        $status = omit,
        $tag = omit,
        $tags = omit,
        $tenantID = omit,
        $traceID = omit,
        ?RequestOptions $requestOptions = null,
    ): MessageListResponse {
        $params = [
            'archived' => $archived,
            'cursor' => $cursor,
            'enqueuedAfter' => $enqueuedAfter,
            'event' => $event,
            'list' => $list,
            'messageID' => $messageID,
            'notification' => $notification,
            'provider' => $provider,
            'recipient' => $recipient,
            'status' => $status,
            'tag' => $tag,
            'tags' => $tags,
            'tenantID' => $tenantID,
            'traceID' => $traceID,
        ];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return MessageListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): MessageListResponse {
        [$parsed, $options] = MessageListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: 'messages',
            query: $parsed,
            options: $options,
            convert: MessageListResponse::class,
        );
    }

    /**
     * @api
     *
     * Cancel a message that is currently in the process of being delivered. A well-formatted API call to the cancel message API will return either `200` status code for a successful cancellation or `409` status code for an unsuccessful cancellation. Both cases will include the actual message record in the response body (see details below).
     *
     * @return MessageDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageDetails {
        $params = [];

        return $this->cancelRaw($messageID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return MessageDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function cancelRaw(
        string $messageID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): MessageDetails {
        // @phpstan-ignore-next-line;
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
     * @return MessageContentResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageContentResponse {
        $params = [];

        return $this->contentRaw($messageID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @return MessageContentResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function contentRaw(
        string $messageID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): MessageContentResponse {
        // @phpstan-ignore-next-line;
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
     * @param string|null $type a supported Message History type that will filter the events returned
     *
     * @return MessageHistoryResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        $type = omit,
        ?RequestOptions $requestOptions = null
    ): MessageHistoryResponse {
        $params = ['type' => $type];

        return $this->historyRaw($messageID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return MessageHistoryResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function historyRaw(
        string $messageID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): MessageHistoryResponse {
        [$parsed, $options] = MessageHistoryParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['messages/%1$s/history', $messageID],
            query: $parsed,
            options: $options,
            convert: MessageHistoryResponse::class,
        );
    }
}
