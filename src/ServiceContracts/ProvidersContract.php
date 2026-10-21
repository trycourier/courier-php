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
     * @param string $provider Body param: The provider key identifying the type (e.g. "sendgrid", "twilio"). Must be a known Courier provider — see the catalog endpoint for valid keys.
     * @param string $alias body param: Optional alias for this configuration
     * @param array<string,mixed> $settings Body param: Provider-specific settings (snake_case keys). Defaults to an empty object when omitted. Use the catalog endpoint to discover required fields for a given provider — omitting a required field returns a 400 validation error. Set `rate_limit` to cap this configuration's send rate: `{ "rate": <number greater than 0>, "period": "second" | "minute" | "hour" }`, e.g. `{ "rate": 0.5, "period": "minute" }` for one send every 2 minutes. The interval between sends (`period` divided by `rate`) must be from 1 millisecond to 12 hours, otherwise the request returns a 400 `InvalidRateLimit` error. The limit applies per configuration and per environment (a test-environment configuration has its own limit). Sends above the rate are queued, not dropped, and changes take up to 60 seconds to apply. It has no effect on observability or CDP integrations, which do not send messages. Omit it or set it to null for no limit.
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
     * @param array<string,mixed> $settings Provider-specific settings (snake_case keys). Replaces the full settings object — omitted settings fields are removed. Use the catalog endpoint to check required fields. Set `rate_limit` to cap this configuration's send rate: `{ "rate": <number greater than 0>, "period": "second" | "minute" | "hour" }`, e.g. `{ "rate": 0.5, "period": "minute" }` for one send every 2 minutes. The interval between sends (`period` divided by `rate`) must be from 1 millisecond to 12 hours, otherwise the request returns a 400 `InvalidRateLimit` error. The limit applies per configuration and per environment (a test-environment configuration has its own limit). Sends above the rate are queued, not dropped, and changes take up to 60 seconds to apply. It has no effect on observability or CDP integrations, which do not send messages. Omitting `rate_limit` or setting it to null removes any existing limit, including one set in Studio.
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

    /**
     * @api
     *
     * @param string $id a unique identifier of the provider configuration to update
     * @param string|null $alias Updated alias. Set to null to clear it.
     * @param string $provider The provider key identifying the type. Optional. When sent, it must match the stored provider, otherwise the request returns a 400.
     * @param array<string,mixed> $settings Provider-specific settings (snake_case keys) to merge into the stored settings, using JSON Merge Patch (RFC 7396). Each key you send replaces the stored value, a key set to null is removed, nested objects merge recursively, and arrays replace the stored value. Keys you omit keep their stored values. Set `rate_limit` to null to remove this configuration's send rate limit.
     * @param string $title updated display title
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function patch(
        string $id,
        ?string $alias = null,
        ?string $provider = null,
        ?array $settings = null,
        ?string $title = null,
        RequestOptions|array|null $requestOptions = null,
    ): Provider;
}
