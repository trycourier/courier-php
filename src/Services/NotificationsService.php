<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationContent;
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\NotificationsContract;
use Courier\Services\Notifications\ChecksService;
use Courier\Services\Notifications\DraftService;

use const Courier\Core\OMIT as omit;

final class NotificationsService implements NotificationsContract
{
    /**
     * @@api
     */
    public ChecksService $checks;

    /**
     * @@api
     */
    public DraftService $draft;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->checks = new ChecksService($client);
        $this->draft = new DraftService($client);
    }

    /**
     * @api
     *
     * @param string|null $cursor
     * @param bool|null $notes retrieve the notes from the Notification template settings
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        $notes = omit,
        ?RequestOptions $requestOptions = null
    ): NotificationListResponse {
        $params = ['cursor' => $cursor, 'notes' => $notes];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): NotificationListResponse {
        [$parsed, $options] = NotificationListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
    ): NotificationContent {
        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/content', $id],
            options: $requestOptions,
            convert: NotificationContent::class,
        );
    }
}
