<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\RequestOptions;

interface DraftRawContract
{
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
    ): BaseResponse;
}
