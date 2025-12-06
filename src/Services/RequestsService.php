<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\RequestsContract;

final class RequestsService implements RequestsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Archive message
     *
     * @throws APIException
     */
    public function archive(
        string $requestID,
        ?RequestOptions $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['requests/%1$s/archive', $requestID],
            options: $requestOptions,
            convert: null,
        );
    }
}
