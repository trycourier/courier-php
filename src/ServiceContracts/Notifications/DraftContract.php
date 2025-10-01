<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\Notifications\NotificationGetContent;
use Courier\RequestOptions;

interface DraftContract
{
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
