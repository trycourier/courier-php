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
     * Create a new provider configuration. The `provider` field must be a known Courier provider key (see catalog).
     *
     * @param string $provider The provider key identifying the type (e.g. "sendgrid", "twilio"). Must be a known Courier provider — see the catalog endpoint for valid keys.
     * @param string $alias optional alias for this configuration
     * @param array<string,mixed> $settings Provider-specific settings (snake_case keys). Defaults to an empty object when omitted. Use the catalog endpoint to discover required fields for a given provider — omitting a required field returns a 400 validation error.
     * @param string $title Optional display title. Omit to use "Default Configuration".
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
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
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch a single provider configuration by ID.
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
     * Replace an existing provider configuration. The `provider` key is required and determines which provider-specific settings schema is applied. All other fields are optional — omitted fields are cleared from the stored configuration (this is a full replacement, not a partial merge). Changing the provider type for an existing configuration is not supported.
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
     * List configured provider integrations for the current workspace. Supports cursor-based pagination.
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
     * Delete a provider configuration. Returns 409 if the provider is still referenced by routing or notifications.
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
