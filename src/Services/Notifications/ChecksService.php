<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\BaseCheck\Status;
use Courier\Notifications\BaseCheck\Type;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\ChecksContract;

final class ChecksService implements ChecksContract
{
    /**
     * @api
     */
    public ChecksRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new ChecksRawService($client);
    }

    /**
     * @api
     *
     * @param string $submissionID Path param:
     * @param string $id Path param:
     * @param list<array{
     *   id: string, status: 'RESOLVED'|'FAILED'|'PENDING'|Status, type: 'custom'|Type
     * }|BaseCheck> $checks Body param:
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        string $id,
        array $checks,
        ?RequestOptions $requestOptions = null,
    ): CheckUpdateResponse {
        $params = Util::removeNulls(['id' => $id, 'checks' => $checks]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($submissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        string $id,
        ?RequestOptions $requestOptions = null
    ): CheckListResponse {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($submissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        string $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->delete($submissionID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
