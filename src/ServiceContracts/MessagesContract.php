<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetContentResponse;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface MessagesContract
{
    /**
     * @api
     *
     * @return MessageGetResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageGetResponse;

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
    ): MessageGetResponse;

    /**
     * @api
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
    ): MessageListResponse;

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
    ): MessageListResponse;

    /**
     * @api
     *
     * @return MessageDetails<HasRawResponse>
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageDetails;

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
    ): MessageDetails;

    /**
     * @api
     *
     * @return MessageGetContentResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getContent(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageGetContentResponse;

    /**
     * @api
     *
     * @return MessageGetContentResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function getContentRaw(
        string $messageID,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): MessageGetContentResponse;

    /**
     * @api
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
    ): MessageHistoryResponse;

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
    ): MessageHistoryResponse;
}
