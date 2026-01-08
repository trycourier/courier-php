<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Auth\AuthIssueTokenParams;
use Courier\Auth\AuthIssueTokenResponse;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface AuthRawContract
{
    /**
     * @api
     *
     * @param array<string,mixed>|AuthIssueTokenParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<AuthIssueTokenResponse>
     *
     * @throws APIException
     */
    public function issueToken(
        array|AuthIssueTokenParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
