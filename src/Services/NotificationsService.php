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
use Courier\ServiceContracts\NotificationsContract;
use Courier\Services\Notifications\ChecksService;
use Courier\Services\Notifications\DraftService;

final class NotificationsService implements NotificationsContract
{
    /**
     * @api
     */
    public DraftService $draft;

    /**
     * @api
     */
    public ChecksService $checks;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->draft = new DraftService($client);
        $this->checks = new ChecksService($client);
    }

    /**
     * @api
     *
     * @param array{
     *   cursor?: string|null, notes?: bool|null
     * }|NotificationListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        ?RequestOptions $requestOptions = null
    ): NotificationListResponse {
        [$parsed, $options] = NotificationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<NotificationListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'notifications',
            query: $parsed,
            options: $options,
            convert: NotificationListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
    ): NotificationGetContent {
        /** @var BaseResponse<NotificationGetContent> */
        $response = $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/content', $id],
            options: $requestOptions,
            convert: NotificationGetContent::class,
        );

        return $response->parse();
    }
}
