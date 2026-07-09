<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\ChannelClassification;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\WorkspacePreferences\PublishPreferencesResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceGetResponse;
use Courier\WorkspacePreferences\WorkspacePreferenceListResponse;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface WorkspacePreferencesContract
{
    /**
     * @api
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
    ): WorkspacePreferenceGetResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): WorkspacePreferenceGetResponse;

    /**
     * @api
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        RequestOptions|array|null $requestOptions = null
    ): WorkspacePreferenceListResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $sectionID,
        RequestOptions|array|null $requestOptions = null
    ): mixed;

    /**
     * @api
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
    ): PublishPreferencesResponse;

    /**
     * @api
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
    ): WorkspacePreferenceGetResponse;
}
