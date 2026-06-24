<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\PreferenceSections\PreferenceSectionCreateParams;
use Courier\PreferenceSections\PreferenceSectionGetResponse;
use Courier\PreferenceSections\PreferenceSectionListResponse;
use Courier\PreferenceSections\PreferenceSectionReplaceParams;
use Courier\PreferenceSections\PublishPreferencesResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\PreferenceSectionsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class PreferenceSectionsRawService implements PreferenceSectionsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a preference section in your workspace. The section id is generated and returned. Topics are created inside a section via POST /preferences/sections/{section_id}/topics.
     *
     * @param array{
     *   name: string,
     *   hasCustomRouting?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     * }|PreferenceSectionCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionGetResponse>
     *
     * @throws APIException
     */
    public function create(
        array|PreferenceSectionCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceSectionCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'preferences/sections',
            body: (object) $parsed,
            options: $options,
            convert: PreferenceSectionGetResponse::class,
        );
    }

    /**
     * @api
     *
     * Retrieve a preference section by id, including its topics.
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionGetResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['preferences/sections/%1$s', $sectionID],
            options: $requestOptions,
            convert: PreferenceSectionGetResponse::class,
        );
    }

    /**
     * @api
     *
     * List the workspace's preference sections. Each section embeds its topics. Scoped to the workspace of the API key.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionListResponse>
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'preferences/sections',
            options: $requestOptions,
            convert: PreferenceSectionListResponse::class,
        );
    }

    /**
     * @api
     *
     * Archive a preference section. The section must be empty: delete its topics first, otherwise the request fails with 409.
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['preferences/sections/%1$s', $sectionID],
            options: $requestOptions,
            convert: null,
        );
    }

    /**
     * @api
     *
     * Publish the workspace's preferences page. Takes a snapshot of every section with its topics under a new published version, making the current state visible on the hosted preferences page (non-draft).
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PublishPreferencesResponse>
     *
     * @throws APIException
     */
    public function publish(
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'preferences/publish',
            options: $requestOptions,
            convert: PublishPreferencesResponse::class,
        );
    }

    /**
     * @api
     *
     * Replace a preference section. Full document replacement; missing optional fields are cleared. Topics attached to the section are unaffected.
     *
     * @param string $sectionID id of the preference section
     * @param array{
     *   name: string,
     *   hasCustomRouting?: bool|null,
     *   routingOptions?: list<ChannelClassification|value-of<ChannelClassification>>|null,
     * }|PreferenceSectionReplaceParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreferenceSectionGetResponse>
     *
     * @throws APIException
     */
    public function replace(
        string $sectionID,
        array|PreferenceSectionReplaceParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = PreferenceSectionReplaceParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['preferences/sections/%1$s', $sectionID],
            body: (object) $parsed,
            options: $options,
            convert: PreferenceSectionGetResponse::class,
        );
    }
}
