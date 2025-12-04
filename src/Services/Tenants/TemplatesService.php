<?php

declare(strict_types=1);

namespace Courier\Services\Tenants;

use Courier\Client;
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
     * @param array{tenant_id: string}|TemplateRetrieveParams $params
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
        $tenantID = $parsed['tenant_id'];
        unset($parsed['tenant_id']);

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
