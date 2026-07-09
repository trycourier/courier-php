<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\WorkspacePreferencesContract;
use Courier\Services\WorkspacePreferences\TopicsService;
use Courier\WorkspacePreferences\PublishPreferencesResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceListResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class WorkspacePreferencesService implements WorkspacePreferencesContract
{
    /**
     * @api
     */
    public WorkspacePreferencesRawService $raw;

    /**
     * @api
     */
    public TopicsService $topics;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new WorkspacePreferencesRawService($client);
        $this->topics = new TopicsService($client);
    }

    /**
     * @api
     *
     * Create a workspace preference. The workspace preference id is generated and returned. Topics are created inside a workspace preference via POST /preferences/sections/{section_id}/topics.
     *
     * @param string $name human-readable name for the workspace preference
     * @param string|null $description optional description shown under the section on the hosted preferences page
     * @param bool|null $hasCustomRouting whether the workspace preference defines custom routing for its topics
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels for the workspace preference. Defaults to empty if omitted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        ?string $description = null,
        ?bool $hasCustomRouting = null,
        ?array $routingOptions = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceGetResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'description' => $description,
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
     * Retrieve a workspace preference by id, including its topics.
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): WorkspacePreferenceGetResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($sectionID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List the workspace's preferences. Each workspace preference embeds its topics. Scoped to the workspace of the API key.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): WorkspacePreferenceListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archive a workspace preference. The workspace preference must be empty: delete its topics first, otherwise the request fails with 409.
     *
     * @param string $sectionID id of the workspace preference
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
     * Publish the workspace's preferences page. Takes a snapshot of every workspace preference with its topics under a new published version, making the current state visible on the hosted preferences page (non-draft).
     *
     * @param string|null $brandID Brand for the hosted page - "default" (workspace default brand), "none" (no brand), or a specific brand id. Defaults to "default".
     * @param string|null $description description shown under the heading on the hosted preferences page
     * @param string|null $heading heading shown at the top of the hosted preferences page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        ?string $brandID = null,
        ?string $description = null,
        ?string $heading = null,
        RequestOptions|array|null $requestOptions = null,
    ): PublishPreferencesResponse {
        $params = Util::removeNulls(
            [
                'brandID' => $brandID,
                'description' => $description,
                'heading' => $heading,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replace a workspace preference. Full document replacement; missing optional fields are cleared. Topics attached to the workspace preference are unaffected.
     *
     * @param string $sectionID id of the workspace preference
     * @param string $name human-readable name for the workspace preference
     * @param string|null $description Optional description shown under the section on the hosted preferences page. Omit to clear.
     * @param bool|null $hasCustomRouting whether the workspace preference defines custom routing for its topics
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels for the workspace preference. Omit to clear.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $sectionID,
        string $name,
        ?string $description = null,
        ?bool $hasCustomRouting = null,
        ?array $routingOptions = null,
        RequestOptions|array|null $requestOptions = null,
    ): WorkspacePreferenceGetResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'description' => $description,
                'hasCustomRouting' => $hasCustomRouting,
                'routingOptions' => $routingOptions,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($sectionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
