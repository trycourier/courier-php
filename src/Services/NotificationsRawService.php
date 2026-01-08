<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class NotificationsRawService implements NotificationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param array{
     *   cursor?: string|null, notes?: bool|null
     * }|NotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = NotificationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'notifications',
            query: $parsed,
            options: $options,
            convert: NotificationListResponse::class,
        );
    }

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationGetContent>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/content', $id],
            options: $requestOptions,
            convert: NotificationGetContent::class,
        );
    }
}
