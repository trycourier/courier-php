<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants\Templates;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\Versions\VersionRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface VersionsRawContract
{
    /**
     * @api
     *
     * @param string $version Version of the template to retrieve. Accepts "latest", "published", or a specific version string (e.g., "v1", "v2").
     * @param array<string,mixed>|VersionRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseTemplateTenantAssociation>
     *
     * @throws APIException
     */
    public function retrieve(
        string $version,
        array|VersionRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
