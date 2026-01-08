<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\TemplatesContract;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\TemplateListResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TemplatesService implements TemplatesContract
{
    /**
     * @api
     */
    public TemplatesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TemplatesRawService($client);
    }

    /**
     * @api
     *
     * Get a Template in Tenant
     *
     * @param string $templateID id of the template to be retrieved
     * @param string $tenantID id of the tenant for which to retrieve the template
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        string $tenantID,
        RequestOptions|array|null $requestOptions = null,
    ): BaseTemplateTenantAssociation {
        $params = Util::removeNulls(['tenantID' => $tenantID]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List Templates in Tenant
     *
     * @param string $tenantID id of the tenant for which to retrieve the templates
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of templates to return (defaults to 20, maximum value of 100)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $tenantID,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): TemplateListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($tenantID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
