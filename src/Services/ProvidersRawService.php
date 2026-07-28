<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
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
     * Configures a provider integration from a Courier provider key and its settings. Check the catalog endpoint for the schema each provider expects.
     *
     * @param array{
     *   provider: string,
     *   alias?: string,
     *   settings?: array<string,mixed>,
     *   title?: string,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
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
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'providers',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: Provider::class,
        );
    }

    /**
     * @api
     *
     * Returns one configured provider by id, including its channel, provider key, alias, title, and current settings.
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
     * Replaces a provider's configuration in full, clearing any field you omit rather than merging it. Send the complete settings object.
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
     * Lists the provider integrations configured in the workspace, one entry per channel and provider key with its alias and settings.
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
     * Deletes a provider configuration, which fails while routing strategies or templates still reference it. Update those references first.
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
