<?php

namespace Courier\Notifications;

use Courier\Core\Client\RawClient;
use Courier\Notifications\Requests\NotificationListParams;
use Courier\Notifications\Types\NotificationListResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Courier\Notifications\Types\NotificationGetContentResponse;
use Courier\Notifications\Types\SubmissionChecksGetResponse;
use Courier\Notifications\Requests\SubmissionChecksReplaceParams;
use Courier\Notifications\Types\SubmissionChecksReplaceResponse;

class NotificationsClient
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
     * @param NotificationListParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return NotificationListResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function list(NotificationListParams $request, ?array $options = null): NotificationListResponse
    {
        $query = [];
        if ($request->cursor != null) {
            $query['cursor'] = $request->cursor;
        }
        if ($request->notes != null) {
            $query['notes'] = $request->notes;
        }
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/notifications",
                    method: HttpMethod::GET,
                    query: $query,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return NotificationListResponse::fromJson($json);
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
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return NotificationGetContentResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getContent(string $id, ?array $options = null): NotificationGetContentResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/notifications/$id/content",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return NotificationGetContentResponse::fromJson($json);
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
     * @param string $id
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return NotificationGetContentResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getDraftContent(string $id, ?array $options = null): NotificationGetContentResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/notifications/$id/draft/content",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return NotificationGetContentResponse::fromJson($json);
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
     * @param string $id
     * @param string $submissionId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return SubmissionChecksGetResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function getSubmissionChecks(string $id, string $submissionId, ?array $options = null): SubmissionChecksGetResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/notifications/$id/$submissionId/checks",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return SubmissionChecksGetResponse::fromJson($json);
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
     * @param string $id
     * @param string $submissionId
     * @param SubmissionChecksReplaceParams $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return SubmissionChecksReplaceResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function replaceSubmissionChecks(string $id, string $submissionId, SubmissionChecksReplaceParams $request, ?array $options = null): SubmissionChecksReplaceResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/notifications/$id/$submissionId/checks",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return SubmissionChecksReplaceResponse::fromJson($json);
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
     * @param string $id
     * @param string $submissionId
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function cancelSubmission(string $id, string $submissionId, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/notifications/$id/$submissionId/checks",
                    method: HttpMethod::DELETE,
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
