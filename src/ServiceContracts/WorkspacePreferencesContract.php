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
     * @param bool|null $hasCustomRouting whether the workspace preference defines custom routing for its topics
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels for the workspace preference. Defaults to empty if omitted.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
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
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        RequestOptions|array|null $requestOptions = null
    ): PublishPreferencesResponse;

    /**
     * @api
     *
     * @param string $sectionID id of the workspace preference
     * @param string $name human-readable name for the workspace preference
     * @param bool|null $hasCustomRouting whether the workspace preference defines custom routing for its topics
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $routingOptions Default channels for the workspace preference. Omit to clear.
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
    ): WorkspacePreferenceGetResponse;
}
