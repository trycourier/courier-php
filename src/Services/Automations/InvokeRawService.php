<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Automations\Invoke\InvokeInvokeByTemplateParams;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\InvokeRawContract;

/**
 * Invoke a stored automation template or an ad hoc automation defined in the request.
 *
 * @phpstan-import-type AutomationShape from \Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class InvokeRawService implements InvokeRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Runs a series of automation steps supplied inline, without a saved template, and returns a runId.
     *
     * @param array{
     *   automation: Automation|AutomationShape,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   profile?: array<string,mixed>|null,
     *   recipient?: string|null,
     *   template?: string|null,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|InvokeInvokeAdHocParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationInvokeResponse>
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        array|InvokeInvokeAdHocParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvokeInvokeAdHocParams::parseRequest(
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
            path: 'automations/invoke',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: AutomationInvokeResponse::class,
        );
    }

    /**
     * @api
     *
     * Starts an automation run from a saved template for one recipient, with optional data and profile, and returns a runId.
     *
     * @param string $templateID Path param: A unique identifier representing the automation template to be invoked. This could be the Automation Template ID or the Automation Template Alias.
     * @param array{
     *   recipient: string|null,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   profile?: array<string,mixed>|null,
     *   template?: string|null,
     *   idempotencyKey?: string,
     *   xIdempotencyExpiration?: string,
     * }|InvokeInvokeByTemplateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationInvokeResponse>
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        array|InvokeInvokeByTemplateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvokeInvokeByTemplateParams::parseRequest(
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
            path: ['automations/%1$s/invoke', $templateID],
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: AutomationInvokeResponse::class,
        );
    }
}
