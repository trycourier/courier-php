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
use Courier\Tenants\Templates\TemplateDeleteParams;
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
     * Returns a tenant's notification template with its content, version, and created, updated, and published timestamps.
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
     * Lists a tenant's notification templates, each carrying its version and published timestamp. Paged.
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
     * Deletes a tenant's notification template by id. Sends for that tenant then use the workspace template registered under the same id.
     *
     * @param string $templateID id of the template to remove from the tenant
     * @param array{tenantID: string}|TemplateDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $templateID,
        array|TemplateDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TemplateDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['tenants/%1$s/templates/%2$s', $tenantID, $templateID],
            options: $options,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Publishes a version of a tenant's notification template, making it the content that tenant's sends render from until you publish another.
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
     * Creates or updates a notification template scoped to one tenant, letting a tenant override the content the workspace template would send.
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
