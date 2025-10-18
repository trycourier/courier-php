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

use const Courier\Core\OMIT as omit;

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
     * @param string $tenantID
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        $tenantID,
        ?RequestOptions $requestOptions = null
    ): BaseTemplateTenantAssociation {
        $params = ['tenantID' => $tenantID];

        return $this->retrieveRaw($templateID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $templateID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): BaseTemplateTenantAssociation {
        [$parsed, $options] = TemplateRetrieveParams::parseRequest(
            $params,
            $requestOptions
        );
        $tenantID = $parsed['tenantID'];
        unset($parsed['tenantID']);

        // @phpstan-ignore-next-line;
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
     * @param string|null $cursor Continue the pagination with the next cursor
     * @param int|null $limit The number of templates to return (defaults to 20, maximum value of 100)
     *
     * @throws APIException
     */
    public function list(
        string $tenantID,
        $cursor = omit,
        $limit = omit,
        ?RequestOptions $requestOptions = null,
    ): TemplateListResponse {
        $params = ['cursor' => $cursor, 'limit' => $limit];

        return $this->listRaw($tenantID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        string $tenantID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): TemplateListResponse {
        [$parsed, $options] = TemplateListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['tenants/%1$s/templates', $tenantID],
            query: $parsed,
            options: $options,
            convert: TemplateListResponse::class,
        );
    }
}
