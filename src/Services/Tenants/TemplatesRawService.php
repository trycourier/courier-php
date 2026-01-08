<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\TemplatesRawContract;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\TemplateListParams;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\Templates\TemplateRetrieveParams;

/**
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
}
