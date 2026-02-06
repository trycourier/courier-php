<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants\Templates;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\BaseTemplateTenantAssociation;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface VersionsContract
{
    /**
     * @api
     *
     * @param string $version Version of the template to retrieve. Accepts "latest", "published", or a specific version string (e.g., "v1", "v2").
     * @param string $tenantID id of the tenant for which to retrieve the template
     * @param string $templateID id of the template to be retrieved
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $version,
        string $tenantID,
        string $templateID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseTemplateTenantAssociation;
}
