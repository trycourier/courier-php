<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\AudienceFilterConfig;
use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersParams;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListParams;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateParams;
use Courier\Audiences\AudienceUpdateParams\Operator;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AudiencesRawContract;

/**
 * Define filter-based groups whose membership Courier recalculates as user profiles change.
 *
 * @phpstan-import-type AudienceFilterConfigShape from \Courier\AudienceFilterConfig
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class AudiencesRawService implements AudiencesRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns one audience with its name, description, and the filter and AND or OR operator that decide which users belong to it.
     *
     * @param string $audienceID A unique identifier representing the audience_id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<Audience>
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['audiences/%1$s', $audienceID],
            options: $requestOptions,
            convert: Audience::class,
        );
    }

    /**
     * @api
     *
     * Creates or replaces an audience from a filter and an AND or OR operator. Membership recalculates automatically as profiles change.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array{
     *   description?: string|null,
     *   filter?: AudienceFilterConfig|AudienceFilterConfigShape|null,
     *   name?: string|null,
     *   operator?: Operator|value-of<Operator>|null,
     * }|AudienceUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AudienceUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        array|AudienceUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AudienceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['audiences/%1$s', $audienceID],
            body: (object) $parsed,
            options: $options,
            convert: AudienceUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * Returns the audiences in the workspace with paging. Audiences are filter-based groups that recalculate as user profiles change.
     *
     * @param array{cursor?: string|null}|AudienceListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AudienceListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AudienceListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AudienceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'audiences',
            query: $parsed,
            options: $options,
            convert: AudienceListResponse::class,
        );
    }

    /**
     * @api
     *
     * Deletes an audience permanently, so update any caller sending to it by audience id first. Those sends fail once the audience is gone.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['audiences/%1$s', $audienceID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Returns the users currently matching an audience filter, with paging. Membership is recalculated, so results shift as profiles change.
     *
     * @param string $audienceID A unique identifier representing the audience id
     * @param array{cursor?: string|null}|AudienceListMembersParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AudienceListMembersResponse>
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        array|AudienceListMembersParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AudienceListMembersParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['audiences/%1$s/members', $audienceID],
            query: $parsed,
            options: $options,
            convert: AudienceListMembersResponse::class,
        );
    }
}
