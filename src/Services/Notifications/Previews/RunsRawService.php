<?php

declare(strict_types=1);

namespace Courier\Services\Notifications\Previews;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\Previews\Runs\PreviewRun;
use Courier\Notifications\Previews\Runs\PreviewRunDetail;
use Courier\Notifications\Previews\Runs\PreviewRunListResponse;
use Courier\Notifications\Previews\Runs\RunCreateParams;
use Courier\Notifications\Previews\Runs\RunListParams;
use Courier\Notifications\Previews\Runs\RunRetrieveParams;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\Previews\RunsRawContract;

/**
 * Render a template's email content on real email clients and read back the screenshots, so you can check how it looks before you send it.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RunsRawService implements RunsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Render this template's email content on each of the requested devices.
     *
     * Returns as soon as the run exists and its render is queued — the screenshots are produced asynchronously. Poll `GET /notifications/{id}/previews/runs/{previewRunId}` until every result reaches a terminal status.
     *
     * Name the devices either with `device_set_id`, for a saved set, or with `device_ids`, for a one-off list. Exactly one of the two is required. Inline `device_ids` must be ids listed by `GET /previews/devices`; any other id is a 422, refused before the run exists or is billed.
     *
     * A template that does not exist is a 404. One that exists but cannot be previewed — not a Design Studio template, no email channel, or no such `template_version` — is a 422, also refused before the run exists or is billed.
     *
     * Preview runs are a metered add-on. A workspace without it, or with its billing suspended, receives a 402.
     *
     * @param string $id Path param: Template ID (nt_ prefix). Must be a Design Studio template.
     * @param array{
     *   data?: array<string,mixed>,
     *   deviceIDs?: list<string>,
     *   deviceSetID?: string,
     *   locale?: string,
     *   templateVersion?: string,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|RunCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreviewRun>
     *
     * @throws APIException
     */
    public function create(
        string $id,
        array|RunCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = [
            'idempotencyKey' => 'Idempotency-Key',
            'xIdempotencyExpiration' => 'x-idempotency-expiration',
        ];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['notifications/%1$s/previews/runs', $id],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: PreviewRun::class,
        );
    }

    /**
     * @api
     *
     * Retrieve one of this template's preview runs together with its per-device results.
     *
     * A run is only readable under the template it previewed: under any other template it is a 404, the same as a run that does not exist.
     *
     * `thumbnail_url` and `screenshot_url` are short-lived signed URLs, re-signed on every read. Fetch them now rather than storing them. Both are null until Courier's own copy of the image exists, which is what `status: COMPLETED` on a result means.
     *
     * @param string $previewRunID the preview run to retrieve, identified by the `id` returned when it was created
     * @param array{id: string}|RunRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreviewRunDetail>
     *
     * @throws APIException
     */
    public function retrieve(
        string $previewRunID,
        array|RunRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $id = $parsed['id'];
        unset($parsed['id']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/previews/runs/%2$s', $id, $previewRunID],
            options: $options,
            convert: PreviewRunDetail::class,
        );
    }

    /**
     * @api
     *
     * List this template's preview runs, newest first. Cursor-paginated.
     *
     * A template that does not exist is a 404, the same as every other `/notifications/{id}` route.
     *
     * @param string $id template ID (nt_ prefix)
     * @param array{cursor?: string|null, limit?: int}|RunListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<PreviewRunListResponse>
     *
     * @throws APIException
     */
    public function list(
        string $id,
        array|RunListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = RunListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['notifications/%1$s/previews/runs', $id],
            query: $parsed,
            options: $options,
            convert: PreviewRunListResponse::class,
        );
    }
}
