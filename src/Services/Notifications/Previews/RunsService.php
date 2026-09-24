<?php

declare(strict_types=1);

namespace Courier\Services\Notifications\Previews;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\Notifications\Previews\Runs\PreviewRun;
use Courier\Notifications\Previews\Runs\PreviewRunDetail;
use Courier\Notifications\Previews\Runs\PreviewRunListResponse;
use Courier\RequestOptions;
use Courier\ServiceContracts\Notifications\Previews\RunsContract;

/**
 * Render a template's email content on real email clients and read back the screenshots, so you can check how it looks before you send it.
 *
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class RunsService implements RunsContract
{
    /**
     * @api
     */
    public RunsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new RunsRawService($client);
    }

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
     * @param array<string,mixed> $data body param: Template variables to render with, the same shape as the `data` object on a send
     * @param list<string> $deviceIDs Body param: The devices to render on, by `PreviewDevice.id`, for a one-off run. Mutually exclusive with `device_set_id`.
     * @param string $deviceSetID Body param: A saved device set naming the devices to render on. Mutually exclusive with `device_ids`.
     * @param string $locale Body param: Render the template's content for this locale, e.g. "fr-FR".
     * @param string $templateVersion Body param: Which version of the template to render. Omit for the latest saved draft, which always exists and is what the editor shows. `published` renders the live version; a zero-padded `v002` renders that specific publish. Versions are 1-based, so `v000` is not a version, and the unpadded `v2` is rejected — that spelling belongs to journeys' AutomationVersionId, a different scheme in which `v0` means published.
     * @param string $idempotencyKey Header param: A unique key that makes this request idempotent. If Courier receives another request with the same `Idempotency-Key`, it returns the stored response from the first request without performing the operation again (including the original status code and any error). Use it to safely retry `POST` requests after network failures without risking duplicate sends. The key is scoped to this endpoint.
     * @param string $xIdempotencyExpiration Header param: How long the idempotency key remains valid, as a Unix epoch timestamp in seconds or an ISO 8601 date string. Only applies when `Idempotency-Key` is provided. If omitted, the key is retained for 25 hours; the maximum is 1 year.
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function create(
        string $id,
        ?array $data = null,
        ?array $deviceIDs = null,
        ?string $deviceSetID = null,
        ?string $locale = null,
        ?string $templateVersion = null,
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreviewRun {
        $params = Util::removeNulls(
            [
                'data' => $data,
                'deviceIDs' => $deviceIDs,
                'deviceSetID' => $deviceSetID,
                'locale' => $locale,
                'templateVersion' => $templateVersion,
                'idempotencyKey' => $idempotencyKey,
                'xIdempotencyExpiration' => $xIdempotencyExpiration,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->create($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
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
     * @param string $id template ID (nt_ prefix)
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $previewRunID,
        string $id,
        RequestOptions|array|null $requestOptions = null,
    ): PreviewRunDetail {
        $params = Util::removeNulls(['id' => $id]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($previewRunID, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * List this template's preview runs, newest first. Cursor-paginated.
     *
     * A template that does not exist is a 404, the same as every other `/notifications/{id}` route.
     *
     * @param string $id template ID (nt_ prefix)
     * @param string|null $cursor Opaque pagination cursor from a previous response. Omit for the first page.
     * @param int $limit maximum number of results per page
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function list(
        string $id,
        ?string $cursor = null,
        ?int $limit = null,
        RequestOptions|array|null $requestOptions = null,
    ): PreviewRunListResponse {
        $params = Util::removeNulls(['cursor' => $cursor, 'limit' => $limit]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->list($id, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
