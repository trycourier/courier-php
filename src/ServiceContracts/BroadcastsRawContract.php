<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Broadcasts\Broadcast;
use Courier\Broadcasts\BroadcastCreateParams;
use Courier\Broadcasts\BroadcastListParams;
use Courier\Broadcasts\BroadcastListResponse;
use Courier\Broadcasts\BroadcastPutContentParams;
use Courier\Broadcasts\BroadcastRetrieveContentParams;
use Courier\Broadcasts\BroadcastScheduleParams;
use Courier\Broadcasts\BroadcastSendParams;
use Courier\Broadcasts\BroadcastUpdateParams;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationContentGetResponse;
use Courier\Notifications\NotificationContentMutationResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface BroadcastsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|BroadcastCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function create(
        array|BroadcastCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast to retrieve, identified by the `id` returned when it was created
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function retrieve(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast to rename
     * @param array<string,mixed>|BroadcastUpdateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|BroadcastListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BroadcastListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|BroadcastListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast to archive
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function archive(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast to cancel
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function cancel(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID The broadcast to copy. The duplicate is created as a new draft and this broadcast is left unchanged.
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Broadcast>
     *
     * @throws APIException
     */
    public function duplicate(
        string $broadcastID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast whose content you want to replace
     * @param array<string,mixed>|BroadcastPutContentParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast whose content you want to read
     * @param array<string,mixed>|BroadcastRetrieveContentParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast to schedule
     * @param array<string,mixed>|BroadcastScheduleParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $broadcastID the broadcast to send
     * @param array<string,mixed>|BroadcastSendParams $params
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
    ): BaseResponse;
}
