<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendSendMessageParams\Message;
use Courier\Send\SendSendMessageResponse;

interface SendContract
{
    /**
     * @api
     *
     * @param Message $message The message property has the following primary top-level properties. They define the destination and content of the message.
     *
     * @throws APIException
     */
    public function sendMessage(
        $message,
        ?RequestOptions $requestOptions = null
    ): SendSendMessageResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function sendMessageRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): SendSendMessageResponse;
}
