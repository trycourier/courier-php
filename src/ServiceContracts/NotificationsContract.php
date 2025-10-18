<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
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
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): NotificationListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        ?RequestOptions $requestOptions = null
    ): NotificationGetContent;
}
