<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\AudienceFilterConfig;
use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateParams\Operator;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type AudienceFilterConfigShape from \Courier\AudienceFilterConfig
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AudiencesContract
{
    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience_id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): Audience;

    /**
     * @api
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
    ): AudienceUpdateResponse;

    /**
     * @api
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of audiences
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        RequestOptions|array|null $requestOptions = null
    ): AudienceListResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): AudienceListMembersResponse;
}
