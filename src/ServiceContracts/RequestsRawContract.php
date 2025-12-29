<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface RequestsRawContract
{
    /**
     * @api
     *
     * @param string $requestID A unique identifier representing the request ID
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
