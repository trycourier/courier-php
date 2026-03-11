<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\Journeys\JourneyListParams\Version;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface JourneysContract
{
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
     * @param string $templateID A unique identifier representing the journey template to be invoked. This could be the Journey Template ID or the Journey Template Alias.
     * @param array<string,mixed> $data Data payload passed to the journey. The expected shape can be predefined using the schema builder in the journey editor. This data is available in journey steps for condition evaluation and template variable interpolation. Can also contain user identifiers (user_id, userId, anonymousId) if not provided elsewhere.
     * @param array<string,mixed> $profile Profile data for the user. Can contain contact information (email, phone_number), user identifiers (user_id, userId, anonymousId), or any custom profile fields. Profile fields are merged with any existing stored profile for the user. Include context.tenant_id to load a tenant-scoped profile for multi-tenant scenarios.
     * @param string $userID A unique identifier for the user. If not provided, the system will attempt to resolve the user identifier from profile or data objects.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function invoke(
        string $templateID,
        ?array $data = null,
        ?array $profile = null,
        ?string $userID = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneysInvokeResponse;
}
