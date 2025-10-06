<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface RequestsContract
{
    /**
     * @api
     *
     * @throws APIException
     */
    public function archive(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
