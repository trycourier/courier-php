<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Messages\MessageContentResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\MessagesContract;

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
     * Fetch the status of a message you've previously sent.
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($messageID, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param list<string|null> $provider The key assocated to the provider you want to filter on. E.g., sendgrid, inbox, twilio, slack, msteams, etc. Allows multiple values to be set in query parameters.
     * @param string|null $recipient a unique identifier representing the recipient associated with the requested profile
     * @param list<string|null> $status An indicator of the current status of the message. Allows multiple values to be set in query parameters.
     * @param list<string|null> $tag A tag placed in the metadata.tags during a notification send. Allows multiple values to be set in query parameters.
     * @param string|null $tags A comma delimited list of 'tags'. Messages will be returned if they match any of the tags passed in.
     * @param string|null $tenantID Messages sent with the context of a Tenant
     * @param string|null $traceID The unique identifier used to trace the requests
     *
     * @throws APIException
     */
    public function list(
        ?bool $archived = null,
        ?string $cursor = null,
        ?string $enqueuedAfter = null,
        ?string $event = null,
        ?string $list = null,
        ?string $messageID = null,
        ?string $notification = null,
        ?array $provider = null,
        ?string $recipient = null,
        ?array $status = null,
        ?array $tag = null,
        ?string $tags = null,
        ?string $tenantID = null,
        ?string $traceID = null,
        ?RequestOptions $requestOptions = null,
    ): MessageListResponse {
        $params = Util::removeNulls(
            [
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
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a message that is currently in the process of being delivered. A well-formatted API call to the cancel message API will return either `200` status code for a successful cancellation or `409` status code for an unsuccessful cancellation. Both cases will include the actual message record in the response body (see details below).
     *
     * @param string $messageID A unique identifier representing the message ID
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageDetails {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Get message content
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageContentResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->content($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch the array of events of a message you've previously sent.
     *
     * @param string $messageID A unique identifier representing the message ID
     * @param string|null $type a supported Message History type that will filter the events returned
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        ?string $type = null,
        ?RequestOptions $requestOptions = null,
    ): MessageHistoryResponse {
        $params = Util::removeNulls(['type' => $type]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->history($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
