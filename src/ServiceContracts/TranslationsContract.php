<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;

interface TranslationsContract
{
    /**
     * @api
     *
     * @param string $domain
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        $domain,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function retrieveRaw(
        string $locale,
        array $params,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @param string $domain
     * @param string $body
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        $domain,
        $body,
        ?RequestOptions $requestOptions = null
    ): mixed;

    /**
     * @api
     *
     * @param array<string, mixed> $params
     *
     * @throws APIException
     */
    public function updateRaw(
        string $locale,
        array $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
