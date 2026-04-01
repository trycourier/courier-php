<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Providers;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Providers\Catalog\CatalogListParams;
use Courier\Providers\Catalog\CatalogListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface CatalogRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|CatalogListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CatalogListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|CatalogListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
