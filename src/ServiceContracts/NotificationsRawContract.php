<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\Notifications\NotificationListParams;
use Courier\Notifications\NotificationListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface NotificationsRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|NotificationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<NotificationListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|NotificationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

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
    ): BaseResponse;
}
