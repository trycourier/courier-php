<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Audiences\Audience;
use Courier\Audiences\AudienceListMembersParams;
use Courier\Audiences\AudienceListMembersResponse;
use Courier\Audiences\AudienceListParams;
use Courier\Audiences\AudienceListResponse;
use Courier\Audiences\AudienceUpdateParams;
use Courier\Audiences\AudienceUpdateResponse;
use Courier\Audiences\Filter;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AudiencesContract;

final class AudiencesService implements AudiencesContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Returns the specified audience by id.
     *
     * @throws APIException
     */
    public function retrieve(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): Audience {
        /** @var BaseResponse<Audience> */
        $response = $this->client->request(
            method: 'get',
            path: ['audiences/%1$s', $audienceID],
            options: $requestOptions,
            convert: Audience::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Creates or updates audience.
     *
     * @param array{
     *   description?: string|null,
     *   filter?: array{
     *     operator: 'ENDS_WITH'|'EQ'|'EXISTS'|'GT'|'GTE'|'INCLUDES'|'IS_AFTER'|'IS_BEFORE'|'LT'|'LTE'|'NEQ'|'OMIT'|'STARTS_WITH'|'AND'|'OR',
     *     path: string,
     *     value: string,
     *   }|Filter|null,
     *   name?: string|null,
     * }|AudienceUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        array|AudienceUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse {
        [$parsed, $options] = AudienceUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<AudienceUpdateResponse> */
        $response = $this->client->request(
            method: 'put',
            path: ['audiences/%1$s', $audienceID],
            body: (object) $parsed,
            options: $options,
            convert: AudienceUpdateResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get the audiences associated with the authorization token.
     *
     * @param array{cursor?: string|null}|AudienceListParams $params
     *
     * @throws APIException
     */
    public function list(
        array|AudienceListParams $params,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse {
        [$parsed, $options] = AudienceListParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<AudienceListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: 'audiences',
            query: $parsed,
            options: $options,
            convert: AudienceListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Deletes the specified audience.
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['audiences/%1$s', $audienceID],
            options: $requestOptions,
            convert: null,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Get list of members of an audience.
     *
     * @param array{cursor?: string|null}|AudienceListMembersParams $params
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        array|AudienceListMembersParams $params,
        ?RequestOptions $requestOptions = null,
    ): AudienceListMembersResponse {
        [$parsed, $options] = AudienceListMembersParams::parseRequest(
            $params,
            $requestOptions,
        );

        /** @var BaseResponse<AudienceListMembersResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['audiences/%1$s/members', $audienceID],
            query: $parsed,
            options: $options,
            convert: AudienceListMembersResponse::class,
        );

        return $response->parse();
    }
}
