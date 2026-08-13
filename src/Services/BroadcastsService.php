<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Broadcasts\Broadcast;
use Courier\Broadcasts\BroadcastCreateParams\Channel;
use Courier\Broadcasts\BroadcastListResponse;
use Courier\Broadcasts\BroadcastPutContentParams\Content;
use Courier\Broadcasts\BroadcastScheduleParams\RecipientType;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\RequestOptions;
use Courier\ServiceContracts\BroadcastsContract;

/**
 * Create a one-off send to a list or audience, author its content, then send it immediately or schedule it for later.
 *
 * @phpstan-import-type ContentShape from \Courier\Broadcasts\BroadcastPutContentParams\Content
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class BroadcastsService implements BroadcastsContract
{
    /**
     * @api
     */
    public BroadcastsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new BroadcastsRawService($client);
    }

    /**
     * @api
     *
     * Create a broadcast. Provisions a private notification template for the broadcast and returns the new broadcast in the draft state. Exactly one channel is required.
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
    ): Broadcast {
        $params = Util::removeNulls(['channel' => $channel, 'name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a broadcast by ID. Archived broadcasts return 404.
     *
     * @param string $broadcastID the broadcast to retrieve, identified by the `id` returned when it was created
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($broadcastID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a broadcast's name. Content is edited via the broadcast's notification template, not this endpoint.
     *
     * @param string $broadcastID the broadcast to rename
     * @param string $name new human-readable name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $broadcastID,
        string $name,
        RequestOptions|array|null $requestOptions = null,
    ): Broadcast {
        $params = Util::removeNulls(['name' => $name]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($broadcastID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List broadcasts in your workspace. Cursor-paginated; returns broadcasts newest-first.
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
    ): BroadcastListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a broadcast. This is a soft delete — the archived broadcast is returned and no longer appears in list results.
     *
     * @param string $broadcastID the broadcast to archive
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($broadcastID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancel a broadcast's pending schedule, returning it to the draft state. Only valid for a scheduled broadcast.
     *
     * @param string $broadcastID the broadcast to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel($broadcastID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Duplicate a broadcast (and its template) into a new draft named "{source name} (copy)".
     *
     * @param string $broadcastID The broadcast to copy. The duplicate is created as a new draft and this broadcast is left unchanged.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function duplicate(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): Broadcast {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->duplicate($broadcastID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Author the broadcast's content by replacing the draft elemental content of its private notification template. The draft is published automatically when the broadcast is sent or scheduled.
     *
     * @param string $broadcastID the broadcast whose content you want to replace
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
    ): NotificationContentMutationResponse {
        $params = Util::removeNulls(['content' => $content, 'state' => $state]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->putContent($broadcastID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve the broadcast's content — the elemental content of its private notification template. Defaults to the working draft, since broadcast content is authored as a draft until the broadcast is sent.
     *
     * @param string $broadcastID the broadcast whose content you want to read
     * @param string $version Accepts `draft`, `published`, or a version string (e.g. `v001`). Defaults to `draft`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $broadcastID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationContentGetResponse {
        $params = Util::removeNulls(['version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieveContent($broadcastID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Schedule a broadcast for a future send to a list or audience. Publishes the broadcast template first. Not allowed once the broadcast is sending or sent. For an immediate send use POST /broadcasts/{broadcastId}/send.
     *
     * @param string $broadcastID the broadcast to schedule
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
    ): Broadcast {
        $params = Util::removeNulls(
            [
                'recipientID' => $recipientID,
                'recipientType' => $recipientType,
                'scheduledTo' => $scheduledTo,
                'timezone' => $timezone,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->schedule($broadcastID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Send a broadcast immediately to a list or audience. Publishes the broadcast template first. Not allowed once the broadcast is sending or sent.
     *
     * @param string $broadcastID the broadcast to send
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
    ): Broadcast {
        $params = Util::removeNulls(
            ['recipientID' => $recipientID, 'recipientType' => $recipientType]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->send($broadcastID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
