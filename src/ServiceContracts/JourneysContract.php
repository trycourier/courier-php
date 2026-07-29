<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Journeys\CancelJourneyResponse\RunIDBranch;
use Courier\Journeys\CancelJourneyResponse\TokenBranch;
use Courier\Journeys\JourneyListParams\Version;
use Courier\Journeys\JourneyResponse;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\Journeys\JourneyState;
use Courier\Journeys\JourneyVersionsListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface JourneysContract
{
    /**
     * @api
     *
     * @param string $name Body param
     * @param list<mixed> $nodes Body param
     * @param bool $enabled Body param
     * @param JourneyState|value-of<JourneyState> $state body param: Lifecycle state of a journey
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        array $nodes,
        ?bool $enabled = null,
        JourneyState|string|null $state = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param string $version version selector: `draft`, `published` (default), or `vN`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse;

    /**
     * @api
     *
     * @param string $cursor A cursor token for pagination. Use the cursor from the previous response to fetch the next page of results.
     * @param Version|value-of<Version> $version The version of journeys to retrieve. Accepted values are published (for published journeys) or draft (for draft journeys). Defaults to published.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        Version|string $version = 'published',
        RequestOptions|array|null $requestOptions = null,
    ): JourneysListResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $cancelationToken Body param
     * @param string $runID Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $cancelationToken,
        string $runID,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): TokenBranch|RunIDBranch;

    /**
     * @api
     *
     * @param string $templateID Path param: A unique identifier representing the journey to be invoked. Accepts a Journey ID or Journey Alias.
     * @param array<string,mixed> $data Body param: Data payload passed to the journey. The expected shape can be predefined using the schema builder in the journey editor. This data is available in journey steps for condition evaluation and template variable interpolation. Can also contain user identifiers (user_id, userId, anonymousId) if not provided elsewhere.
     * @param array<string,mixed> $profile Body param: Profile data for the user. Can contain contact information (email, phone_number), user identifiers (user_id, userId, anonymousId), or any custom profile fields. Profile fields are merged with any existing stored profile for the user. Include context.tenant_id to load a tenant-scoped profile for multi-tenant scenarios.
     * @param string $userID Body param: A unique identifier for the user. If not provided, the system will attempt to resolve the user identifier from profile or data objects.
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function invoke(
        string $templateID,
        ?array $data = null,
        ?array $profile = null,
        ?string $userID = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneysInvokeResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listVersions(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): JourneyVersionsListResponse;

    /**
     * @api
     *
     * @param string $templateID Path param: Journey id
     * @param string $version Body param
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        string $templateID,
        ?string $version = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse;

    /**
     * @api
     *
     * @param string $templateID Journey id
     * @param list<mixed> $nodes
     * @param JourneyState|value-of<JourneyState> $state lifecycle state of a journey
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $templateID,
        string $name,
        array $nodes,
        ?bool $enabled = null,
        JourneyState|string|null $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse;
}
