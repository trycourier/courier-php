<?php

declare(strict_types=1);

namespace Courier\Services\Tenants\Templates;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\Templates\VersionsRawContract;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\Versions\VersionRetrieveParams;

/**
 * Manage the templates and template versions scoped to a single tenant, including the ones authored in the embedded designer.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class VersionsRawService implements VersionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns one version of a tenant template, addressed by version number or by latest, with its content and publish timestamp.
     *
     * @param string $version Version of the template to retrieve. Accepts "latest", "published", or a specific version string (e.g., "v1", "v2").
     * @param array{tenantID: string, templateID: string}|VersionRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = VersionRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);
        $templateID = $parsed['templateID'];
        unset($parsed['templateID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: [
                'tenants/%1$s/templates/%2$s/versions/%3$s',
                $tenantID,
                $templateID,
                $version,
            ],
            options: $options,
            convert: BaseTemplateTenantAssociation::class,
        );
    }
}
