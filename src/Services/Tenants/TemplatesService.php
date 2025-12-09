<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Tenants\TemplatesContract;
use Courier\Tenants\BaseTemplateTenantAssociation;
use Courier\Tenants\Templates\TemplateListParams;
use Courier\Tenants\Templates\TemplateListResponse;
use Courier\Tenants\Templates\TemplateRetrieveParams;

final class TemplatesService implements TemplatesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get a Template in Tenant
     *
     * @param array{tenantID: string}|TemplateRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        array|TemplateRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseTemplateTenantAssociation {
        [$parsed, $options] = TemplateRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        /** @var BaseResponse<BaseTemplateTenantAssociation> */
        $response = $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/templates/%2$s', $tenantID, $templateID],
            options: $options,
            convert: BaseTemplateTenantAssociation::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * List Templates in Tenant
     *
     * @param array{cursor?: string|null, limit?: int|null}|TemplateListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $tenantID,
        array|TemplateListParams $params,
        ?RequestOptions $requestOptions = null,
    ): TemplateListResponse {
        [$parsed, $options] = TemplateListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<TemplateListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/templates', $tenantID],
            query: $parsed,
            options: $options,
            convert: TemplateListResponse::class,
        );

        return $response->parse();
    }
}
