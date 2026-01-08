<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\NotificationGetContent;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface DraftContract
{
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
