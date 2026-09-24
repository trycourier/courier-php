<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications\Previews;

use Courier\Core\Exceptions\APIException;
use Courier\Notifications\Previews\Runs\PreviewRun;
use Courier\Notifications\Previews\Runs\PreviewRunDetail;
use Courier\Notifications\Previews\Runs\PreviewRunListResponse;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RunsContract
{
    /**
     * @api
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
    ): PreviewRun;

    /**
     * @api
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
    ): PreviewRunDetail;

    /**
     * @api
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
    ): PreviewRunListResponse;
}
