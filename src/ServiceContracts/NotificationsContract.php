<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;

interface NotificationsContract
{
    /**
     * @api
     *
     * @param bool|null $notes retrieve the notes from the Notification template settings
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?bool $notes = null,
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
