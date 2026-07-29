<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Broadcasts\Broadcast;
use Courier\Broadcasts\BroadcastCreateParams\Channel;
use Courier\Broadcasts\BroadcastListResponse;
use Courier\Broadcasts\BroadcastPutContentParams\Content;
use Courier\Broadcasts\BroadcastScheduleParams\RecipientType;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\RequestOptions;

/**
 * @phpstan-import-type ContentShape from \Courier\Broadcasts\BroadcastPutContentParams\Content
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface BroadcastsContract
{
    /**
     * @api
     *
     * @param Channel|value-of<Channel> $channel the single delivery channel for this broadcast
     * @param string $name human-readable name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        Channel|string $channel,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): Broadcast;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast;

    /**
     * @api
     *
     * @param string $name new human-readable name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $broadcastID,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): Broadcast;

    /**
     * @api
     *
     * @param string|null $cursor Opaque pagination cursor from a previous response. Omit for the first page.
     * @param int $limit maximum number of results per page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): BroadcastListResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function duplicate(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast;

    /**
     * @api
     *
     * @param Content|ContentShape $content Elemental content payload. The server defaults `version` when omitted.
     * @param NotificationTemplateState|value-of<NotificationTemplateState> $state Template state. Defaults to `DRAFT`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function putContent(
        string $broadcastID,
        Content|array $content,
        NotificationTemplateState|string $state = 'DRAFT',
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentMutationResponse;

    /**
     * @api
     *
     * @param string $version Accepts `draft`, `published`, or a version string (e.g. `v001`). Defaults to `draft`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $broadcastID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentGetResponse;

    /**
     * @api
     *
     * @param string $recipientID ID of the target list or audience
     * @param RecipientType|value-of<RecipientType> $recipientType whether the broadcast targets a list or an audience
     * @param string $scheduledTo Wall-clock timestamp of the future send, no timezone offset (e.g. "2026-07-21T20:00:00"). The zone is given by `timezone`.
     * @param string $timezone IANA timezone for the scheduled send (e.g. America/New_York).
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function schedule(
        string $broadcastID,
        string $recipientID,
        RecipientType|string $recipientType,
        string $scheduledTo,
        ?string $timezone = null,
        RequestOptions|array|null $requestOptions = null,
    ): Broadcast;

    /**
     * @api
     *
     * @param string $recipientID ID of the target list or audience
     * @param \Courier\Broadcasts\BroadcastSendParams\RecipientType|value-of<\Courier\Broadcasts\BroadcastSendParams\RecipientType> $recipientType whether the broadcast targets a list or an audience
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function send(
        string $broadcastID,
        string $recipientID,
        \Courier\Broadcasts\BroadcastSendParams\RecipientType|string $recipientType,
        RequestOptions|array|null $requestOptions = null,
    ): Broadcast;
}
