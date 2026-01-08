<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Automations\AutomationListParams\Version;
use Courier\Automations\AutomationTemplateListResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AutomationsContract
{
    /**
     * @api
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
    ): AutomationTemplateListResponse;
}
