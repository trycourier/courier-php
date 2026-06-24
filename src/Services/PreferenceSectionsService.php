<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\PreferenceSections\PreferenceSectionGetResponse;
use Courier\PreferenceSections\PreferenceSectionListResponse;
use Courier\PreferenceSections\PublishPreferencesResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\PreferenceSectionsContract;
use Courier\Services\PreferenceSections\TopicsService;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class PreferenceSectionsService implements PreferenceSectionsContract
{
    /**
     * @api
     */
    public PreferenceSectionsRawService $raw;

    /**
     * @api
     */
    public TopicsService $topics;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new PreferenceSectionsRawService($client);
        $this->topics = new TopicsService($client);
    }

    /**
     * @api
     *
     * Create a preference section in your workspace. The section id is generated and returned. Topics are created inside a section via POST /preferences/sections/{section_id}/topics.
     *
     * @param string $name human-readable name for the section
     * @param bool|null $hasCustomRouting whether the section defines custom routing for its topics
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels for the section. Defaults to empty if omitted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?bool $hasCustomRouting = null,
        ?array $routingOptions = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceSectionGetResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'hasCustomRouting' => $hasCustomRouting,
                'routingOptions' => $routingOptions,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Retrieve a preference section by id, including its topics.
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): PreferenceSectionGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($sectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the workspace's preference sections. Each section embeds its topics. Scoped to the workspace of the API key.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): PreferenceSectionListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a preference section. The section must be empty: delete its topics first, otherwise the request fails with 409.
     *
     * @param string $sectionID id of the preference section
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($sectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Publish the workspace's preferences page. Takes a snapshot of every section with its topics under a new published version, making the current state visible on the hosted preferences page (non-draft).
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        RequestOptions|array|null $requestOptions = null
    ): PublishPreferencesResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace a preference section. Full document replacement; missing optional fields are cleared. Topics attached to the section are unaffected.
     *
     * @param string $sectionID id of the preference section
     * @param string $name human-readable name for the section
     * @param bool|null $hasCustomRouting whether the section defines custom routing for its topics
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels for the section. Omit to clear.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $sectionID,
        string $name,
        ?bool $hasCustomRouting = null,
        ?array $routingOptions = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreferenceSectionGetResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'hasCustomRouting' => $hasCustomRouting,
                'routingOptions' => $routingOptions,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($sectionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
