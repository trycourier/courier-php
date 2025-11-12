<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;

interface NotificationsContract
{
    /**
     * @api
     *
     * @param array<mixed>|NotificationListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        ?RequestOptions $requestOptions = null,
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
