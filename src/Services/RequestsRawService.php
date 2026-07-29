<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\RequestsRawContract;

/**
 * Look up the messages Courier has accepted, inspect their delivery history and rendered output, and cancel, resend, or archive them.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RequestsRawService implements RequestsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Archives a send request by its request id. Use it to remove test sends or superseded requests from the message list without deleting them.
     *
     * @param string $requestID A unique identifier representing the request ID
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function archive(
        string $requestID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['requests/%1$s/archive', $requestID],
            options: $requestOptions,
            convert: null,
        );
    }
}
