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
     *
     * @return BaseResponse<NotificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        ?RequestOptions $requestOptions = null
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
     * @return BaseResponse<NotificationGetContent>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
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
