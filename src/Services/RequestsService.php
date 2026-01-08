<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\RequestsContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RequestsService implements RequestsContract
{
    /**
     * @api
     */
    public RequestsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RequestsRawService($client);
    }

    /**
     * @api
     *
     * Archive message
     *
     * @param string $requestID A unique identifier representing the request ID
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function archive(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): mixed {
        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->archive($requestID, requestOptions: $requestOptions);

        return $response->parse();
    }
}
