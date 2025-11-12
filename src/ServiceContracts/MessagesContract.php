<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Messages\MessageContentResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryParams;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListParams;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;

interface MessagesContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageGetResponse;

    /**
     * @api
     *
     * @param array<mixed>|MessageListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|MessageListParams $params,
        ?RequestOptions $requestOptions = null
    ): MessageListResponse;

    /**
     * @api
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageDetails;

    /**
     * @api
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): MessageContentResponse;

    /**
     * @api
     *
     * @param array<mixed>|MessageHistoryParams $params
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        array|MessageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): MessageHistoryResponse;
}
