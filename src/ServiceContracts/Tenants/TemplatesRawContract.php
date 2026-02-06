<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\PostTenantTemplatePublishResponse;
use Courier\Tenants\PutTenantTemplateResponse;
use Courier\Tenants\Templates\TemplateListParams;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\Templates\TemplatePublishParams;
use Courier\Tenants\Templates\TemplateReplaceParams;
use Courier\Tenants\Templates\TemplateRetrieveParams;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TemplatesRawContract
{
    /**
     * @api
     *
     * @param string $templateID id of the template to be retrieved
     * @param array<string,mixed>|TemplateRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<BaseTemplateTenantAssociation>
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        array|TemplateRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $tenantID id of the tenant for which to retrieve the templates
     * @param array<string,mixed>|TemplateListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TemplateListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $tenantID,
        array|TemplateListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID path param: Id of the template to be published
     * @param array<string,mixed>|TemplatePublishParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PostTenantTemplatePublishResponse>
     *
     * @throws APIException
     */
    public function publish(
        string $templateID,
        array|TemplatePublishParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $templateID path param: Id of the template to be created or updated
     * @param array<string,mixed>|TemplateReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PutTenantTemplateResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $templateID,
        array|TemplateReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
