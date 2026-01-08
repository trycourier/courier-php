<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface SendRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|SendMessageParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<SendMessageResponse>
     *
     * @throws APIException
     */
    public function message(
        array|SendMessageParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
