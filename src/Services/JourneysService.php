<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Journeys\CancelJourneyResponse\RunIDBranch;
use Courier\Journeys\CancelJourneyResponse\TokenBranch;
use Courier\Journeys\JourneyListParams\Version;
use Courier\Journeys\JourneyResponse;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\Journeys\JourneyState;
use Courier\Journeys\JourneyVersionsListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\JourneysContract;
use Courier\Services\Journeys\TemplatesService;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class JourneysService implements JourneysContract
{
    /**
     * @api
     */
    public JourneysRawService $raw;

    /**
     * @api
     */
    public TemplatesService $templates;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new JourneysRawService($client);
        $this->templates = new TemplatesService($client);
    }

    /**
     * @api
     *
     * Creates a journey from a set of nodes, in draft state unless you pass a published state. Send nodes cannot be included until their templates exist.
     *
     * @param list<mixed> $nodes
     * @param JourneyState|value-of<JourneyState> $state lifecycle state of a journey
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $name,
        array $nodes,
        ?bool $enabled = null,
        JourneyState|string|null $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'nodes' => $nodes,
                'enabled' => $enabled,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Fetch a journey by id. Pass `?version=draft` (default `published`) to retrieve the working draft, or `?version=vN` to retrieve a historical version.
     *
     * @param string $templateID Journey id
     * @param string $version version selector: `draft`, `published` (default), or `vN`
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $templateID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse {
        $params = Util::removeNulls(['version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists the workspace's journeys, each carrying a name, state, and enabled flag. Paged by cursor.
     *
     * @param string $cursor A cursor token for pagination. Use the cursor from the previous response to fetch the next page of results.
     * @param Version|value-of<Version> $version The version of journeys to retrieve. Accepted values are published (for published journeys) or draft (for draft journeys). Defaults to published.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        Version|string $version = 'published',
        RequestOptions|array|null $requestOptions = null,
    ): JourneysListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Archives a journey so it can no longer be invoked. Runs already in flight continue to completion, so archiving never strands a user mid-sequence.
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($templateID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Cancels in-flight journey runs, either every run sharing a cancelation token or one run by id. Use it to stop a sequence when the event resolves.
     *
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function cancel(
        string $cancelationToken,
        string $runID,
        RequestOptions|array|null $requestOptions = null,
    ): TokenBranch|RunIDBranch {
        $params = Util::removeNulls(
            ['cancelationToken' => $cancelationToken, 'runID' => $runID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->cancel(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Starts a journey run for one user and returns a runId. Runs execute asynchronously, so the response arrives before any message is sent.
     *
     * @param string $templateID A unique identifier representing the journey to be invoked. Accepts a Journey ID or Journey Alias.
     * @param array<string,mixed> $data Data payload passed to the journey. The expected shape can be predefined using the schema builder in the journey editor. This data is available in journey steps for condition evaluation and template variable interpolation. Can also contain user identifiers (user_id, userId, anonymousId) if not provided elsewhere.
     * @param array<string,mixed> $profile Profile data for the user. Can contain contact information (email, phone_number), user identifiers (user_id, userId, anonymousId), or any custom profile fields. Profile fields are merged with any existing stored profile for the user. Include context.tenant_id to load a tenant-scoped profile for multi-tenant scenarios.
     * @param string $userID A unique identifier for the user. If not provided, the system will attempt to resolve the user identifier from profile or data objects.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function invoke(
        string $templateID,
        ?array $data = null,
        ?array $profile = null,
        ?string $userID = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneysInvokeResponse {
        $params = Util::removeNulls(
            ['data' => $data, 'profile' => $profile, 'userID' => $userID]
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->invoke($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Lists a journey's published versions, most recent first, so you have a version id to roll back to. Paged by cursor.
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function listVersions(
        string $templateID,
        RequestOptions|array|null $requestOptions = null
    ): JourneyVersionsListResponse {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->listVersions($templateID, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Publishes a journey's current draft as a new version, making it live for new runs. Pass a version instead to roll back to an earlier one.
     *
     * @param string $templateID Journey id
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function publish(
        string $templateID,
        ?string $version = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse {
        $params = Util::removeNulls(['version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->publish($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Replaces a journey's working draft, leaving the published version live until you publish. Reach for this when editing a journey already running.
     *
     * @param string $templateID Journey id
     * @param list<mixed> $nodes
     * @param JourneyState|value-of<JourneyState> $state lifecycle state of a journey
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function replace(
        string $templateID,
        string $name,
        array $nodes,
        ?bool $enabled = null,
        JourneyState|string|null $state = null,
        RequestOptions|array|null $requestOptions = null,
    ): JourneyResponse {
        $params = Util::removeNulls(
            [
                'name' => $name,
                'nodes' => $nodes,
                'enabled' => $enabled,
                'state' => $state,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->replace($templateID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
