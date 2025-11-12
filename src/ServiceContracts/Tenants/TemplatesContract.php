<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\TemplateListParams;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\Templates\TemplateRetrieveParams;

interface TemplatesContract
{
    /**
     * @api
     *
     * @param array<mixed>|TemplateRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        array|TemplateRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseTemplateTenantAssociation;

    /**
     * @api
     *
     * @param array<mixed>|TemplateListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $tenantID,
        array|TemplateListParams $params,
        ?RequestOptions $requestOptions = null,
    ): TemplateListResponse;
}
