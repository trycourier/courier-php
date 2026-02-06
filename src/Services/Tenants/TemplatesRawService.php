<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\TemplatesRawContract;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\PostTenantTemplatePublishResponse;
use Courier\Tenants\PutTenantTemplateResponse;
use Courier\Tenants\Templates\TemplateListParams;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\Templates\TemplatePublishParams;
use Courier\Tenants\Templates\TemplateReplaceParams;
use Courier\Tenants\Templates\TemplateRetrieveParams;
use Courier\Tenants\TenantTemplateInput;

/**
 * @phpstan-import-type TenantTemplateInputShape from \Courier\Tenants\TenantTemplateInput
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TemplatesRawService implements TemplatesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a Template in Tenant
     *
     * @param string $templateID id of the template to be retrieved
     * @param array{tenantID: string}|TemplateRetrieveParams $params
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
    ): BaseResponse {
        [$parsed, $options] = TemplateRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/templates/%2$s', $tenantID, $templateID],
            options: $options,
            convert: BaseTemplateTenantAssociation::class,
        );
    }

    /**
     * @api
     *
     * List Templates in Tenant
     *
     * @param string $tenantID id of the tenant for which to retrieve the templates
     * @param array{cursor?: string|null, limit?: int|null}|TemplateListParams $params
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
    ): BaseResponse {
        [$parsed, $options] = TemplateListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/templates', $tenantID],
            query: $parsed,
            options: $options,
            convert: TemplateListResponse::class,
        );
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
     * @param array{tenantID: string, version?: string}|TemplatePublishParams $params
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
    ): BaseResponse {
        [$parsed, $options] = TemplatePublishParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['tenants/%1$s/templates/%2$s/publish', $tenantID, $templateID],
            body: (object) array_diff_key($parsed, array_flip(['tenantID'])),
            options: $options,
            convert: PostTenantTemplatePublishResponse::class,
        );
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
     * @param array{
     *   tenantID: string,
     *   template: TenantTemplateInput|TenantTemplateInputShape,
     *   published?: bool,
     * }|TemplateReplaceParams $params
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
    ): BaseResponse {
        [$parsed, $options] = TemplateReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['tenants/%1$s/templates/%2$s', $tenantID, $templateID],
            body: (object) array_diff_key($parsed, array_flip(['tenantID'])),
            options: $options,
            convert: PutTenantTemplateResponse::class,
        );
    }
}
