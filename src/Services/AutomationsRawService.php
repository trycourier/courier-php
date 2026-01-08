<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Automations\AutomationListParams;
use Courier\Automations\AutomationListParams\Version;
use Courier\Automations\AutomationTemplateListResponse;
use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\AutomationsRawContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class AutomationsRawService implements AutomationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get the list of automations.
     *
     * @param array{
     *   cursor?: string, version?: Version|value-of<Version>
     * }|AutomationListParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AutomationTemplateListResponse>
     *
     * @throws APIException
     */
    public function list(
        array|AutomationListParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = AutomationListParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'automations',
            query: $parsed,
            options: $options,
            convert: AutomationTemplateListResponse::class,
        );
    }
}
