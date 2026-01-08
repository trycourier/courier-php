<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface NotificationsContract
{
    /**
     * @api
     *
     * @param bool|null $notes retrieve the notes from the Notification template settings
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?bool $notes = null,
        RequestOptions|array|null $requestOptions = null,
    ): NotificationListResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieveContent(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): NotificationGetContent;
}
