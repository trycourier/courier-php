<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RequestsContract
{
    /**
     * @api
     *
     * @param string $requestID A unique identifier representing the request ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
