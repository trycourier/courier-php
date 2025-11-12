<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Send\SendMessageParams;
use Courier\Send\SendMessageResponse;

interface SendContract
{
    /**
     * @api
     *
     * @param array<mixed>|SendMessageParams $params
     *
     * @throws APIException
     */
    public function message(
        array|SendMessageParams $params,
        ?RequestOptions $requestOptions = null
    ): SendMessageResponse;
}
