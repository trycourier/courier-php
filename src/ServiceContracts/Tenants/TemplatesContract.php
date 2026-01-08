<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\TemplateListResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TemplatesContract
{
    /**
     * @api
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
    ): BaseTemplateTenantAssociation;

    /**
     * @api
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
    ): TemplateListResponse;
}
