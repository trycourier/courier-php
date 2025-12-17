<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Messages\MessageContentResponse;
use Courier\Messages\MessageDetails;
use Courier\Messages\MessageGetResponse;
use Courier\Messages\MessageHistoryParams;
use Courier\Messages\MessageHistoryResponse;
use Courier\Messages\MessageListParams;
use Courier\Messages\MessageListResponse;
use Courier\RequestOptions;

interface MessagesRawContract
{
    /**
     * @api
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     *
     * @return BaseResponse<MessageGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param array<string,mixed>|MessageListParams $params
     *
     * @return BaseResponse<MessageListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|MessageListParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $messageID A unique identifier representing the message ID
     *
     * @return BaseResponse<MessageDetails>
     *
     * @throws APIException
     */
    public function cancel(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $messageID a unique identifier associated with the message you wish to retrieve (results from a send)
     *
     * @return BaseResponse<MessageContentResponse>
     *
     * @throws APIException
     */
    public function content(
        string $messageID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $messageID A unique identifier representing the message ID
     * @param array<string,mixed>|MessageHistoryParams $params
     *
     * @return BaseResponse<MessageHistoryResponse>
     *
     * @throws APIException
     */
    public function history(
        string $messageID,
        array|MessageHistoryParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
