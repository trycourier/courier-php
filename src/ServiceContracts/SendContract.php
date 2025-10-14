<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageResponse;

interface SendContract
{
    /**
     * @api
     *
     * @param Message $message The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @throws APIException
     */
    public function message(
        $message,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function messageRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse;
}
