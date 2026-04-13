<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Providers\Provider;
use Courier\Providers\ProviderCreateParams;
use Courier\Providers\ProviderListParams;
use Courier\Providers\ProviderListResponse;
use Courier\Providers\ProviderUpdateParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\ProvidersRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ProvidersRawService implements ProvidersRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new provider configuration. The `provider` field must be a known Courier provider key (see catalog).
     *
     * @param array{
     *   provider: string,
     *   alias?: string,
     *   settings?: array<string,mixed>,
     *   title?: string,
     * }|ProviderCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Provider>
     *
     * @throws APIException
     */
    public function create(
        array|ProviderCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProviderCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'providers',
            body: (object) $parsed,
            options: $options,
            convert: Provider::class,
        );
    }

    /**
     * @api
     *
     * Fetch a single provider configuration by ID.
     *
     * @param string $id a unique identifier of the provider configuration
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Provider>
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['providers/%1$s', $id],
            options: $requestOptions,
            convert: Provider::class,
        );
    }

    /**
     * @api
     *
     * Replace an existing provider configuration. The `provider` key is required and determines which provider-specific settings schema is applied. All other fields are optional — omitted fields are cleared from the stored configuration (this is a full replacement, not a partial merge). Changing the provider type for an existing configuration is not supported.
     *
     * @param string $id a unique identifier of the provider configuration to update
     * @param array{
     *   provider: string,
     *   alias?: string,
     *   settings?: array<string,mixed>,
     *   title?: string,
     * }|ProviderUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Provider>
     *
     * @throws APIException
     */
    public function update(
        string $id,
        array|ProviderUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProviderUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['providers/%1$s', $id],
            body: (object) $parsed,
            options: $options,
            convert: Provider::class,
        );
    }

    /**
     * @api
     *
     * List configured provider integrations for the current workspace. Supports cursor-based pagination.
     *
     * @param array{cursor?: string}|ProviderListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ProviderListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|ProviderListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ProviderListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'providers',
            query: $parsed,
            options: $options,
            convert: ProviderListResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete a provider configuration. Returns 409 if the provider is still referenced by routing or notifications.
     *
     * @param string $id a unique identifier of the provider configuration to delete
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['providers/%1$s', $id],
            options: $requestOptions,
            convert: null,
        );
    }
}
