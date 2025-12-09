<?php

declare(strict_types=1);

namespace Courier\Services\Automations;

use Courier\Automations\AutomationInvokeResponse;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams;
use Courier\Automations\Invoke\InvokeInvokeByTemplateParams;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\Automations\InvokeRawContract;

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
     * Invoke an ad hoc automation run. This endpoint accepts a JSON payload with a series of automation steps. For information about what steps are available, checkout the ad hoc automation guide [here](https://www.courier.com/docs/automations/steps/).
     *
     * @param array{
     *   automation: array{
     *     steps: list<array<string,mixed>>, cancelationToken?: string|null
     *   },
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   profile?: array<string,mixed>|null,
     *   recipient?: string|null,
     *   template?: string|null,
     * }|InvokeInvokeAdHocParams $params
     *
     * @return BaseResponse<AutomationInvokeResponse>
     *
     * @throws APIException
     */
    public function invokeAdHoc(
        array|InvokeInvokeAdHocParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvokeInvokeAdHocParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'automations/invoke',
            body: (object) $parsed,
            options: $options,
            convert: AutomationInvokeResponse::class,
        );
    }

    /**
     * @api
     *
     * Invoke an automation run from an automation template.
     *
     * @param string $templateID A unique identifier representing the automation template to be invoked. This could be the Automation Template ID or the Automation Template Alias.
     * @param array{
     *   recipient: string|null,
     *   brand?: string|null,
     *   data?: array<string,mixed>|null,
     *   profile?: array<string,mixed>|null,
     *   template?: string|null,
     * }|InvokeInvokeByTemplateParams $params
     *
     * @return BaseResponse<AutomationInvokeResponse>
     *
     * @throws APIException
     */
    public function invokeByTemplate(
        string $templateID,
        array|InvokeInvokeByTemplateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = InvokeInvokeByTemplateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['automations/%1$s/invoke', $templateID],
            body: (object) $parsed,
            options: $options,
            convert: AutomationInvokeResponse::class,
        );
    }
}
