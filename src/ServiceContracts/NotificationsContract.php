<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;

use const Courier\Core\OMIT as omit;

interface NotificationsContract
{
    /**
     * @api
     *
     * @param string|null $cursor
     * @param bool|null $notes retrieve the notes from the Notification template settings
     *
     * @return NotificationListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        $notes = omit,
        ?RequestOptions $requestOptions = null
    ): NotificationListResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return NotificationListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): NotificationListResponse;

    /**
     * @api
     *
     * @return NotificationGetContent<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
    ): NotificationGetContent;

    /**
     * @api
     *
     * @return NotificationGetContent<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveContentRaw(
        string $id,
        mixed $params,
        ?RequestOptions $requestOptions = null
    ): NotificationGetContent;
}
