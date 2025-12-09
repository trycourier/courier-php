<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Audiences\Filter;
use Courier\Audiences\Filter\Operator;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface AudiencesContract
{
    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience_id
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): Audience;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $description A description of the audience
     * @param array{
     *   operator: 'ENDS_WITH'|'EQ'|'EXISTS'|'GT'|'GTE'|'INCLUDES'|'IS_AFTER'|'IS_BEFORE'|'LT'|'LTE'|'NEQ'|'OMIT'|'STARTS_WITH'|'AND'|'OR'|Operator,
     *   path: string,
     *   value: string,
     * }|Filter|null $filter A single filter to use for filtering
     * @param string|null $name The name of the audience
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        ?string $description = null,
        array|Filter|null $filter = null,
        ?string $name = null,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse;

    /**
     * @api
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of audiences
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param string|null $cursor A unique identifier that allows for fetching the next set of members
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        ?string $cursor = null,
        ?RequestOptions $requestOptions = null,
    ): AudienceListMembersResponse;
}
