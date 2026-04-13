<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Providers\Provider;
use Courier\Providers\ProviderListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface ProvidersContract
{
    /**
     * @api
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
    ): Provider;

    /**
     * @api
     *
     * @param string $id a unique identifier of the provider configuration
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): Provider;

    /**
     * @api
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
    ): Provider;

    /**
     * @api
     *
     * @param string $cursor opaque cursor for fetching the next page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): ProviderListResponse;

    /**
     * @api
     *
     * @param string $id a unique identifier of the provider configuration to delete
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $id,
        RequestOptions|array|null $requestOptions = null
    ): mixed;
}
