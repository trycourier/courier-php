<?php

declare(strict_types=1);

namespace Courier\Services\Tenants\Templates;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\Templates\VersionsContract;
use Courier\Tenants\BaseTemplateTenantAssociation;

/**
 * Manage the templates and template versions scoped to a single tenant, including the ones authored in the embedded designer.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class VersionsService implements VersionsContract
{
    /**
     * @api
     */
    public VersionsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new VersionsRawService($client);
    }

    /**
     * @api
     *
     * Returns one version of a tenant template, addressed by version number or by latest, with its content and publish timestamp.
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
    ): BaseTemplateTenantAssociation {
        $params = Util::removeNulls(
            ['tenantID' => $tenantID, 'templateID' => $templateID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($version, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
