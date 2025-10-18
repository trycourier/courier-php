<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\Checks\CheckDeleteParams;
use Courier\Notifications\Checks\CheckListParams;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateParams;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\ChecksContract;

final class ChecksService implements ChecksContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $id
     * @param list<BaseCheck> $checks
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        $id,
        $checks,
        ?RequestOptions $requestOptions = null
    ): CheckUpdateResponse {
        $params = ['id' => $id, 'checks' => $checks];

        return $this->updateRaw($submissionID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $submissionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): CheckUpdateResponse {
        [$parsed, $options] = CheckUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            body: (object) array_diff_key($parsed, ['id']),
            options: $options,
            convert: CheckUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        $id,
        ?RequestOptions $requestOptions = null
    ): CheckListResponse {
        $params = ['id' => $id];

        return $this->listRaw($submissionID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function listRaw(
        string $submissionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): CheckListResponse {
        [$parsed, $options] = CheckListParams::parseRequest(
            $params,
            $requestOptions
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            options: $options,
            convert: CheckListResponse::class,
        );
    }

    /**
     * @api
     *
     * @param string $id
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        $id,
        ?RequestOptions $requestOptions = null
    ): mixed {
        $params = ['id' => $id];

        return $this->deleteRaw($submissionID, $params, $requestOptions);
    }

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function deleteRaw(
        string $submissionID,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = CheckDeleteParams::parseRequest(
            $params,
            $requestOptions
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'delete',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            options: $options,
            convert: null,
        );
    }
}
