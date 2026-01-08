<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Audiences\NestedFilterConfig;
use Courier\Audiences\SingleFilterConfig;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type FilterShape from \Courier\Audiences\Filter
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
     * @param FilterShape|null $filter A single filter to use for filtering
     * @param string|null $name The name of the audience
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        ?string $description = null,
        SingleFilterConfig|array|NestedFilterConfig|null $filter = null,
        ?string $name = null,
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
