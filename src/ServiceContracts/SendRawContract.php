<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageResponse;

interface SendRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|SendMessageParams $params
     *
     * @return BaseResponse<SendMessageResponse>
     *
     * @throws APIException
     */
    public function message(
        array|SendMessageParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
