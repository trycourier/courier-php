<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\PostTenantTemplatePublishResponse;
use Courier\Tenants\PutTenantTemplateResponse;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\TenantTemplateInput;

/**
 * @phpstan-import-type TenantTemplateInputShape from \Courier\Tenants\TenantTemplateInput
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

    /**
     * @api
     *
     * @param string $templateID path param: Id of the template to be published
     * @param string $tenantID path param: Id of the tenant that owns the template
     * @param string $version Body param: The version of the template to publish (e.g., "v1", "v2", "latest"). If not provided, defaults to "latest".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        string $templateID,
        string $tenantID,
        string $version = 'latest',
        RequestOptions|array|null $requestOptions = null,
    ): PostTenantTemplatePublishResponse;

    /**
     * @api
     *
     * @param string $templateID path param: Id of the template to be created or updated
     * @param string $tenantID path param: Id of the tenant for which to create or update the template
     * @param TenantTemplateInput|TenantTemplateInputShape $template Body param: Template configuration for creating or updating a tenant notification template
     * @param bool $published Body param: Whether to publish the template immediately after saving. When true, the template becomes the active/published version. When false (default), the template is saved as a draft.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $templateID,
        string $tenantID,
        TenantTemplateInput|array $template,
        bool $published = false,
        RequestOptions|array|null $requestOptions = null,
    ): PutTenantTemplateResponse;
}
