<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\Send\Message\ContentMessage;
use Courier\Send\Message\TemplateMessage;
use Courier\Send\SendSendMessageResponse;

interface SendContract
{
    /**
     * @api
     *
     * @param ContentMessage|TemplateMessage $message Defines the message to be delivered
     *
     * @return SendSendMessageResponse<HasRawResponse>
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
     * @return SendSendMessageResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function sendMessageRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): SendSendMessageResponse;
}
