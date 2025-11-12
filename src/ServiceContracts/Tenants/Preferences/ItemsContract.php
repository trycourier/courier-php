<?php

declare(strict_types=1);

namespace Courier\ServiceContracts\Tenants\Preferences;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Tenants\Preferences\Items\ItemDeleteParams;
use Courier\Tenants\Preferences\Items\ItemUpdateParams;

interface ItemsContract
{
    /**
     * @api
     *
     * @param array<mixed>|ItemUpdateParams $params
     *
     * @throws APIException
     */
    public function update(
        string $topicID,
        array|ItemUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;

    /**
     * @api
     *
     * @param array<mixed>|ItemDeleteParams $params
     *
     * @throws APIException
     */
    public function delete(
        string $topicID,
        array|ItemDeleteParams $params,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
