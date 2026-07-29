<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AudienceFilterConfig;
use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateParams\Operator;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\AudiencesContract;

/**
 * Define filter-based groups whose membership Courier recalculates as user profiles change.
 *
 * @phpstan-import-type AudienceFilterConfigShape from \Courier\AudienceFilterConfig
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class AudiencesService implements AudiencesContract
{
    /**
     * @api
     */
    public AudiencesRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AudiencesRawService($client);
    }

    /**
     * @api
     *
     * Returns one audience with its name, description, and the filter and AND or OR operator that decide which users belong to it.
     *
     * @param string $audienceID A unique identifier representing the audience_id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): Audience {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($audienceID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates or replaces an audience from a filter and an AND or OR operator. Membership recalculates automatically as profiles change.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $description A description of the audience
     * @param AudienceFilterConfig|AudienceFilterConfigShape|null $filter Filter configuration for audience membership containing an array of filter rules
     * @param string|null $name The name of the audience
     * @param Operator|value-of<Operator>|null $operator The logical operator (AND/OR) combining the top-level `filter.filters`. Convenience alias for `filter.operator`: if set, it is applied to the top-level filter group. Prefer setting `operator` directly inside `filter`.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        ?string $description = null,
        AudienceFilterConfig|array|null $filter = null,
        ?string $name = null,
        Operator|string|null $operator = null,
        RequestOptions|array|null $requestOptions = null,
    ): AudienceUpdateResponse {
        $params = Util::removeNulls(
            [
                'description' => $description,
                'filter' => $filter,
                'name' => $name,
                'operator' => $operator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($audienceID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the audiences in the workspace with paging. Audiences are filter-based groups that recalculate as user profiles change.
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of audiences
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): AudienceListResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes an audience permanently, so update any caller sending to it by audience id first. Those sends fail once the audience is gone.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($audienceID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Returns the users currently matching an audience filter, with paging. Membership is recalculated, so results shift as profiles change.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $cursor A unique identifier that allows for fetching the next set of members
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null,
    ): AudienceListMembersResponse {
        $params = Util::removeNulls(['cursor' => $cursor]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listMembers($audienceID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
