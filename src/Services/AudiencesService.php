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
     * Returns the specified audience by id.
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
     * Creates or updates audience.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $description A description of the audience
     * @param AudienceFilterConfig|AudienceFilterConfigShape|null $filter Filter configuration for audience membership containing an array of filter rules
     * @param string|null $name The name of the audience
     * @param Operator|value-of<Operator>|null $operator The logical operator (AND/OR) for the top-level filter
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
     * Get the audiences associated with the authorization token.
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
     * Deletes the specified audience.
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
     * Get list of members of an audience.
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
