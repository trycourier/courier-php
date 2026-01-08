<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;

/**
 * @phpstan-import-type MessageShape from \Courier\Send\SendMessageParams\Message
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface SendContract
{
    /**
     * @api
     *
     * @param Message|MessageShape $message The message property has the following primary top-level properties. They define the destination and content of the message.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function message(
        Message|array $message,
        RequestOptions|array|null $requestOptions = null
    ): SendMessageResponse;
}
