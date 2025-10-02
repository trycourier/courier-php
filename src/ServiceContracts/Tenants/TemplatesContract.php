<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants;

use Courier\Core\Exceptions\APIException;
use Courier\Core\Implementation\HasRawResponse;
use Courier\RequestOptions;
use Courier\Tenants\Templates\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\TemplateListResponse;

use const Courier\Core\OMIT as omit;

interface TemplatesContract
{
    /**
     * @api
     *
     * @param string $tenantID
     *
     * @return BaseTemplateTenantAssociation<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        $tenantID,
        ?RequestOptions $requestOptions = null
    ): BaseTemplateTenantAssociation;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return BaseTemplateTenantAssociation<HasRawResponse>
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $templateID,
        array $params,
        ?RequestOptions $requestOptions = null,
    ): BaseTemplateTenantAssociation;

    /**
     * @api
     *
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of templates to return (defaults to 20, maximum value of 100)
     *
     * @return TemplateListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function list(
        string $tenantID,
        $cursor = omit,
        $limit = omit,
        ?RequestOptions $requestOptions = null,
    ): TemplateListResponse;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @return TemplateListResponse<HasRawResponse>
     *
     * @throws APIException
     */
    public function listRaw(
        string $tenantID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TemplateListResponse;
}
