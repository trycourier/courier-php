<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Providers;

use Courier\Core\Exceptions\APIException;
use Courier\Providers\Catalog\CatalogListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface CatalogContract
{
    /**
     * @api
     *
     * @param string $channel Exact match (case-insensitive) against the provider channel taxonomy (e.g. `email`, `sms`, `push`).
     * @param string $keys Comma-separated provider keys to filter by (e.g. `sendgrid,twilio`).
     * @param string $name case-insensitive substring match against the provider display name
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        ?string $channel = null,
        ?string $keys = null,
        ?string $name = null,
        RequestOptions|array|null $requestOptions = null,
    ): CatalogListResponse;
}
