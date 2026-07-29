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
use Courier\Messages\MessageResendResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\MessagesContract;

/**
 * Look up the messages Courier has accepted, inspect their delivery history and rendered output, and cancel, resend, or archive them.
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
     * Returns a sent message's status, recipient, event, and per-provider delivery detail, with timestamps for enqueued, sent, delivered, opened, and clicked.
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): MessageGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns previously sent messages, most recent first, each carrying its status, recipient, channel, and provider. Paged by cursor.
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
     * @param RequestOpts|null $requestOptions
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
        RequestOptions|array|null $requestOptions = null,
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
     * Cancels a message that is still in the delivery pipeline and returns the message record with its resulting canceled or failed status.
     *
     * @param string $messageID A unique identifier representing the message ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): MessageDetails {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the rendered content Courier delivered for a message, broken out per channel, to confirm what the recipient received.
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): MessageContentResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->content($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the ordered event history for a sent message, one entry per status transition with its timestamp.
     *
     * @param string $messageID A unique identifier representing the message ID
     * @param string|null $type a supported Message History type that will filter the events returned
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        ?string $type = null,
        RequestOptions|array|null $requestOptions = null,
    ): MessageHistoryResponse {
        $params = Util::removeNulls(['type' => $type]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->history($messageID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Resends a previously sent message to the same recipient and content, returning a new messageId. The original send request is not modified.
     *
     * @param string $messageID a unique identifier representing the message ID of the original message to resend
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function resend(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): MessageResendResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->resend($messageID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
