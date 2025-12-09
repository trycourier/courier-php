<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\BaseCheck\Status;
use Courier\Notifications\BaseCheck\Type;
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
     * @param array{
     *   id: string,
     *   checks: list<array{
     *     id: string,
     *     status: 'RESOLVED'|'FAILED'|'PENDING'|Status,
     *     type: 'custom'|Type,
     *   }|BaseCheck>,
     * }|CheckUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        array|CheckUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): CheckUpdateResponse {
        [$parsed, $options] = CheckUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        /** @var BaseResponse<CheckUpdateResponse> */
        $response = $this->client->request(
            method: 'put',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            body: (object) array_diff_key($parsed, ['id']),
            options: $options,
            convert: CheckUpdateResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{id: string}|CheckListParams $params
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        array|CheckListParams $params,
        ?RequestOptions $requestOptions = null,
    ): CheckListResponse {
        [$parsed, $options] = CheckListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        /** @var BaseResponse<CheckListResponse> */
        $response = $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            options: $options,
            convert: CheckListResponse::class,
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * @param array{id: string}|CheckDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        array|CheckDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        [$parsed, $options] = CheckDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'delete',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
