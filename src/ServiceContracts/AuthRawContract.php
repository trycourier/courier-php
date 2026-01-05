<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Auth\AuthIssueTokenParams;
use Courier\Auth\AuthIssueTokenResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface AuthRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AuthIssueTokenParams $params
     *
     * @return BaseResponse<AuthIssueTokenResponse>
     *
     * @throws APIException
     */
    public function issueToken(
        array|AuthIssueTokenParams $params,
        ?RequestOptions $requestOptions = null
    ): BaseResponse;
}
