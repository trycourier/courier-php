<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants\Preferences;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\Preferences\Items\ItemDeleteParams;
use Courier\Tenants\Preferences\Items\ItemUpdateParams;

interface ItemsRawContract
{
    /**
     * @api
     *
     * @param string $topicID path param: Id fo the susbcription topic you want to have a default preference for
     * @param array<mixed>|ItemUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        array|ItemUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $topicID id fo the susbcription topic you want to have a default preference for
     * @param array<mixed>|ItemDeleteParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        array|ItemDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
