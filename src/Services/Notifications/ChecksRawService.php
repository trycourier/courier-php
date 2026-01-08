<?php

declare(strict_types=1);

namespace Courier\Services\Notifications;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\BaseCheck;
use Courier\Notifications\Checks\CheckDeleteParams;
use Courier\Notifications\Checks\CheckListParams;
use Courier\Notifications\Checks\CheckListResponse;
use Courier\Notifications\Checks\CheckUpdateParams;
use Courier\Notifications\Checks\CheckUpdateResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\ChecksRawContract;

/**
 * @phpstan-import-type BaseCheckShape from \Courier\Notifications\BaseCheck
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class ChecksRawService implements ChecksRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * @param string $submissionID Path param:
     * @param array{
     *   id: string, checks: list<BaseCheck|BaseCheckShape>
     * }|CheckUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckUpdateResponse>
     *
     * @throws APIException
     */
    public function update(
        string $submissionID,
        array|CheckUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            body: (object) array_diff_key($parsed, array_flip(['id'])),
            options: $options,
            convert: CheckUpdateResponse::class,
        );
    }

    /**
     * @api
     *
     * @param array{id: string}|CheckListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<CheckListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $submissionID,
        array|CheckListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckListParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
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
     * @param array{id: string}|CheckDeleteParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $submissionID,
        array|CheckDeleteParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = CheckDeleteParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['notifications/%1$s/%2$s/checks', $id, $submissionID],
            options: $options,
            convert: null,
        );
    }
}
