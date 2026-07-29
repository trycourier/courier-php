<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Broadcasts\Broadcast;
use Courier\Broadcasts\BroadcastCreateParams;
use Courier\Broadcasts\BroadcastCreateParams\Channel;
use Courier\Broadcasts\BroadcastListParams;
use Courier\Broadcasts\BroadcastListResponse;
use Courier\Broadcasts\BroadcastPutContentParams;
use Courier\Broadcasts\BroadcastPutContentParams\Content;
use Courier\Broadcasts\BroadcastRetrieveContentParams;
use Courier\Broadcasts\BroadcastScheduleParams;
use Courier\Broadcasts\BroadcastScheduleParams\RecipientType;
use Courier\Broadcasts\BroadcastSendParams;
use Courier\Broadcasts\BroadcastUpdateParams;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\Notifications\NotificationTemplateState;
use Courier\RequestOptions;
use Courier\ServiceContracts\BroadcastsRawContract;

/**
 * @phpstan-import-type ContentShape from \Courier\Broadcasts\BroadcastPutContentParams\Content
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class BroadcastsRawService implements BroadcastsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a broadcast. Provisions a private notification template for the broadcast and returns the new broadcast in the draft state. Exactly one channel is required.
     *
     * @param array{
     *   channel: Channel|value-of<Channel>, name: string
     * }|BroadcastCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function create(
        array|BroadcastCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'broadcasts',
            body: (object) $parsed,
            options: $options,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a broadcast by ID. Archived broadcasts return 404.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function retrieve(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['broadcasts/%1$s', $broadcastID],
            options: $requestOptions,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * Update a broadcast's name. Content is edited via the broadcast's notification template, not this endpoint.
     *
     * @param array{name: string}|BroadcastUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function update(
        string $broadcastID,
        array|BroadcastUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['broadcasts/%1$s', $broadcastID],
            body: (object) $parsed,
            options: $options,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * List broadcasts in your workspace. Cursor-paginated; returns broadcasts newest-first.
     *
     * @param array{cursor?: string|null, limit?: int}|BroadcastListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BroadcastListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BroadcastListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'broadcasts',
            query: $parsed,
            options: $options,
            convert: BroadcastListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a broadcast. This is a soft delete — the archived broadcast is returned and no longer appears in list results.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function archive(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['broadcasts/%1$s', $broadcastID],
            options: $requestOptions,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * Cancel a broadcast's pending schedule, returning it to the draft state. Only valid for a scheduled broadcast.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function cancel(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['broadcasts/%1$s/cancel', $broadcastID],
            options: $requestOptions,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * Duplicate a broadcast (and its template) into a new draft named "{source name} (copy)".
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function duplicate(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['broadcasts/%1$s/duplicate', $broadcastID],
            options: $requestOptions,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * Author the broadcast's content by replacing the draft elemental content of its private notification template. The draft is published automatically when the broadcast is sent or scheduled.
     *
     * @param array{
     *   content: Content|ContentShape,
     *   state?: NotificationTemplateState|value-of<NotificationTemplateState>,
     * }|BroadcastPutContentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentMutationResponse>
     *
     * @throws APIException
     */
    public function putContent(
        string $broadcastID,
        array|BroadcastPutContentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastPutContentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['broadcasts/%1$s/content', $broadcastID],
            body: (object) $parsed,
            options: $options,
            convert: NotificationContentMutationResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve the broadcast's content — the elemental content of its private notification template. Defaults to the working draft, since broadcast content is authored as a draft until the broadcast is sent.
     *
     * @param array{version?: string}|BroadcastRetrieveContentParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationContentGetResponse>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $broadcastID,
        array|BroadcastRetrieveContentParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastRetrieveContentParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['broadcasts/%1$s/content', $broadcastID],
            query: $parsed,
            options: $options,
            convert: NotificationContentGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Schedule a broadcast for a future send to a list or audience. Publishes the broadcast template first. Not allowed once the broadcast is sending or sent. For an immediate send use POST /broadcasts/{broadcastId}/send.
     *
     * @param array{
     *   recipientID: string,
     *   recipientType: RecipientType|value-of<RecipientType>,
     *   scheduledTo: string,
     *   timezone?: string,
     * }|BroadcastScheduleParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function schedule(
        string $broadcastID,
        array|BroadcastScheduleParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastScheduleParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['broadcasts/%1$s/schedule', $broadcastID],
            body: (object) $parsed,
            options: $options,
            convert: Broadcast::class,
        );
    }

    /**
     * @api
     *
     * Send a broadcast immediately to a list or audience. Publishes the broadcast template first. Not allowed once the broadcast is sending or sent.
     *
     * @param array{
     *   recipientID: string,
     *   recipientType: BroadcastSendParams\RecipientType|value-of<BroadcastSendParams\RecipientType>,
     * }|BroadcastSendParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function send(
        string $broadcastID,
        array|BroadcastSendParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = BroadcastSendParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['broadcasts/%1$s/send', $broadcastID],
            body: (object) $parsed,
            options: $options,
            convert: Broadcast::class,
        );
    }
}
