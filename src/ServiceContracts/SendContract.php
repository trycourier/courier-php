<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\Send\Message\ContentMessage;
use Courier\Send\Message\TemplateMessage;
use Courier\Send\SendMessageResponse;

interface SendContract
{
    /**
     * @api
     *
     * @param ContentMessage|TemplateMessage $message Defines the message to be delivered
     *
     * @return SendMessageResponse<HasRawResponse>
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
     * @return SendMessageResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function messageRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse;
}
