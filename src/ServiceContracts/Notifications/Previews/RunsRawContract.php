<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Notifications\Previews;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Notifications\Previews\Runs\PreviewRun;
use Courier\Notifications\Previews\Runs\PreviewRunDetail;
use Courier\Notifications\Previews\Runs\PreviewRunListResponse;
use Courier\Notifications\Previews\Runs\RunCreateParams;
use Courier\Notifications\Previews\Runs\RunListParams;
use Courier\Notifications\Previews\Runs\RunRetrieveParams;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface RunsRawContract
{
    /**
     * @api
     *
     * @param string $id Path param: Template ID (nt_ prefix). Must be a Design Studio template.
     * @param array<string,mixed>|RunCreateParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $previewRunID the preview run to retrieve, identified by the `id` returned when it was created
     * @param array<string,mixed>|RunRetrieveParams $params
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
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $id template ID (nt_ prefix)
     * @param array<string,mixed>|RunListParams $params
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
    ): BaseResponse;
}
