<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Inbox;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface MessagesContract
{
    /**
     * @api
     *
     * @param string $messageID the message ID of the inbox message to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $messageID the message ID of the inbox message to restore
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function restore(
        string $messageID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
