<?php

namespace Courier\Messages;

use Courier\Core\Client\RawClient;
use Courier\Messages\Requests\ListMessagesRequest;
use Courier\Messages\Types\ListMessagesResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Messages\Types\MessageDetails;
use Courier\Messages\Requests\GetMessageHistoryRequest;
use Courier\Messages\Types\MessageHistoryResponse;
use Courier\Messages\Types\RenderOutputResponse;

class MessagesClient
{
    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     */
    public function __construct(
        RawClient $client,
    ) {
        $this->client = $client;
    }

    /**
     * Fetch the statuses of messages you've previously sent.
     *
     * @param ListMessagesRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return ListMessagesResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function list(ListMessagesRequest $request, ?array $options = null): ListMessagesResponse
    {
        $query = [];
        if ($request->archived != null) {
            $query['archived'] = $request->archived;
        }
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        if ($request->event != null) {
            $query['event'] = $request->event;
        }
        if ($request->list != null) {
            $query['list'] = $request->list;
        }
        if ($request->messageId != null) {
            $query['messageId'] = $request->messageId;
        }
        if ($request->notification != null) {
            $query['notification'] = $request->notification;
        }
        if ($request->provider != null) {
            $query['provider'] = $request->provider;
        }
        if ($request->recipient != null) {
            $query['recipient'] = $request->recipient;
        }
        if ($request->status != null) {
            $query['status'] = $request->status;
        }
        if ($request->tag != null) {
            $query['tag'] = $request->tag;
        }
        if ($request->tags != null) {
            $query['tags'] = $request->tags;
        }
        if ($request->tenantId != null) {
            $query['tenant_id'] = $request->tenantId;
        }
        if ($request->enqueuedAfter != null) {
            $query['enqueued_after'] = $request->enqueuedAfter;
        }
        if ($request->traceId != null) {
            $query['traceId'] = $request->traceId;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "messages",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return ListMessagesResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Fetch the status of a message you've previously sent.
     *
     * @param string $messageId A unique identifier associated with the message you wish to retrieve (results from a send).
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return MessageDetails
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $messageId, ?array $options = null): MessageDetails
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "messages/$messageId",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MessageDetails::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Cancel a message that is currently in the process of being delivered. A well-formatted API call to the cancel message API will return either `200` status code for a successful cancellation or `409` status code for an unsuccessful cancellation. Both cases will include the actual message record in the response body (see details below).
     *
     * @param string $messageId A unique identifier representing the message ID
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return MessageDetails
     * @throws CourierException
     * @throws CourierApiException
     */
    public function cancel(string $messageId, ?array $options = null): MessageDetails
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "messages/$messageId/cancel",
                    method: HttpMethod::POST,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MessageDetails::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Fetch the array of events of a message you've previously sent.
     *
     * @param string $messageId A unique identifier representing the message ID
     * @param GetMessageHistoryRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return MessageHistoryResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getHistory(string $messageId, GetMessageHistoryRequest $request, ?array $options = null): MessageHistoryResponse
    {
        $query = [];
        if ($request->type != null) {
            $query['type'] = $request->type;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "messages/$messageId/history",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return MessageHistoryResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * @param string $messageId A unique identifier associated with the message you wish to retrieve (results from a send).
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return RenderOutputResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getContent(string $messageId, ?array $options = null): RenderOutputResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "messages/$messageId/output",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return RenderOutputResponse::fromJson($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * @param string $requestId A unique identifier representing the request ID
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function archive(string $requestId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "requests/$requestId/archive",
                    method: HttpMethod::PUT,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
