<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\TemplatesContract;
use Courier\Services\Tenants\Templates\VersionsService;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\PostTenantTemplatePublishResponse;
use Courier\Tenants\PutTenantTemplateResponse;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\TenantTemplateInput;

/**
 * @phpstan-import-type TenantTemplateInputShape from \Courier\Tenants\TenantTemplateInput
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TemplatesService implements TemplatesContract
{
    /**
     * @api
     */
    public TemplatesRawService $raw;

    /**
     * @api
     */
    public VersionsService $versions;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TemplatesRawService($client);
        $this->versions = new VersionsService($client);
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

    /**
     * @api
     *
     * Publishes a specific version of a notification template for a tenant.
     *
     * The template must already exist in the tenant's notification map.
     * If no version is specified, defaults to publishing the "latest" version.
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
    ): PostTenantTemplatePublishResponse {
        $params = Util::removeNulls(
            ['tenantID' => $tenantID, 'version' => $version]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates or updates a notification template for a tenant.
     *
     * If the template already exists for the tenant, it will be updated (200).
     * Otherwise, a new template is created (201).
     *
     * Optionally publishes the template immediately if the `published` flag is set to true.
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
    ): PutTenantTemplateResponse {
        $params = Util::removeNulls(
            [
                'tenantID' => $tenantID,
                'template' => $template,
                'published' => $published,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
