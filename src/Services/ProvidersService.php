<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Providers\Provider;
use Courier\Providers\ProviderListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\ProvidersContract;
use Courier\Services\Providers\CatalogService;

/**
 * Configure the channel providers Courier delivers through, and browse the provider types it supports.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ProvidersService implements ProvidersContract
{
    /**
     * @api
     */
    public ProvidersRawService $raw;

    /**
     * @api
     */
    public CatalogService $catalog;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ProvidersRawService($client);
        $this->catalog = new CatalogService($client);
    }

    /**
     * @api
     *
     * Configures a provider integration from a Courier provider key and its settings. Check the catalog endpoint for the schema each provider expects.
     *
     * @param string $provider Body param: The provider key identifying the type (e.g. "sendgrid", "twilio"). Must be a known Courier provider — see the catalog endpoint for valid keys.
     * @param string $alias body param: Optional alias for this configuration
     * @param array<string,mixed> $settings Body param: Provider-specific settings (snake_case keys). Defaults to an empty object when omitted. Use the catalog endpoint to discover required fields for a given provider — omitting a required field returns a 400 validation error.
     * @param string $title Body param: Optional display title. Omit to use "Default Configuration".
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $provider,
        ?string $alias = null,
        ?array $settings = null,
        ?string $title = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): Provider {
        $params = Util::removeNulls(
            [
                'provider' => $provider,
                'alias' => $alias,
                'settings' => $settings,
                'title' => $title,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns one configured provider by id, including its channel, provider key, alias, title, and current settings.
     *
     * @param string $id a unique identifier of the provider configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Provider {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($id, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replaces a provider's configuration in full, clearing any field you omit rather than merging it. Send the complete settings object.
     *
     * @param string $id a unique identifier of the provider configuration to update
     * @param string $provider The provider key identifying the type. Required on every request because it selects the provider-specific settings schema for validation.
     * @param string $alias Updated alias. Omit to clear.
     * @param array<string,mixed> $settings Provider-specific settings (snake_case keys). Replaces the full settings object — omitted settings fields are removed. Use the catalog endpoint to check required fields.
     * @param string $title updated display title
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $id,
        string $provider,
        ?string $alias = null,
        ?array $settings = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): Provider {
        $params = Util::removeNulls(
            [
                'provider' => $provider,
                'alias' => $alias,
                'settings' => $settings,
                'title' => $title,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists the provider integrations configured in the workspace, one entry per channel and provider key with its alias and settings.
     *
     * @param string $cursor opaque cursor for fetching the next page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): ProviderListResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes a provider configuration, which fails while routing strategies or templates still reference it. Update those references first.
     *
     * @param string $id a unique identifier of the provider configuration to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($id, requestOptions: $requestOptions);

        return $response->parse();
    }
}
