<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Automations\AutomationListParams\Version;
use Courier\Automations\AutomationTemplateListResponse;
use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\AutomationsContract;
use Courier\Services\Automations\InvokeService;

/**
 * Invoke a stored automation template or an ad hoc automation defined in the request.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class AutomationsService implements AutomationsContract
{
    /**
     * @api
     */
    public AutomationsRawService $raw;

    /**
     * @api
     */
    public InvokeService $invoke;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new AutomationsRawService($client);
        $this->invoke = new InvokeService($client);
    }

    /**
     * @api
     *
     * Lists the workspace's saved automation templates, each with its id and a cursor for paging to the next page of results.
     *
     * @param string $cursor A cursor token for pagination. Use the cursor from the previous response to fetch the next page of results.
     * @param Version|value-of<Version> $version The version of templates to retrieve. Accepted values are published (for published templates) or draft (for draft templates). Defaults to published.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $cursor = null,
        Version|string $version = 'published',
        RequestOptions|array|null $requestOptions = null,
    ): AutomationTemplateListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'version' => $version]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
