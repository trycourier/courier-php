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
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AudiencesContract;

use const Courier\Core\OMIT as omit;

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
        // @phpstan-ignore-next-line;
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
     * Creates or updates audience.
     *
     * @param string|null $description A description of the audience
     * @param Filter|null $filter A single filter to use for filtering
     * @param string|null $name The name of the audience
     *
     * @throws APIException
     */
    public function update(
        string $audienceID,
        $description = omit,
        $filter = omit,
        $name = omit,
        ?RequestOptions $requestOptions = null,
    ): AudienceUpdateResponse {
        $params = [
            'description' => $description, 'filter' => $filter, 'name' => $name,
        ];

        return $this->updateRaw($audienceID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $audienceID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): AudienceUpdateResponse {
        [$parsed, $options] = AudienceUpdateParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * Get the audiences associated with the authorization token.
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of audiences
     *
     * @throws APIException
     */
    public function list(
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse {
        $params = ['cursor' => $cursor];

        return $this->listRaw($params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        array $params,
        ?RequestOptions $requestOptions = null
    ): AudienceListResponse {
        [$parsed, $options] = AudienceListParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
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
     * Deletes the specified audience.
     *
     * @throws APIException
     */
    public function delete(
        string $audienceID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line;
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
     * Get list of members of an audience.
     *
     * @param string|null $cursor A unique identifier that allows for fetching the next set of members
     *
     * @throws APIException
     */
    public function listMembers(
        string $audienceID,
        $cursor = omit,
        ?RequestOptions $requestOptions = null
    ): AudienceListMembersResponse {
        $params = ['cursor' => $cursor];

        return $this->listMembersRaw($audienceID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listMembersRaw(
        string $audienceID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): AudienceListMembersResponse {
        [$parsed, $options] = AudienceListMembersParams::parseRequest(
            $params,
            $requestOptions
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['audiences/%1$s/members', $audienceID],
            query: $parsed,
            options: $options,
            convert: AudienceListMembersResponse::class,
        );
    }
}
