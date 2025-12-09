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
     * @param string $locale The locale you want to retrieve the translations for
     * @param string $domain The domain you want to retrieve translations for. Only `default` is supported at the moment
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        string $domain,
        ?RequestOptions $requestOptions = null
    ): string;

    /**
     * @api
     *
     * @param string $locale Path param: The locale you want to retrieve the translations for
     * @param string $domain Path param: The domain you want to retrieve translations for. Only `default` is supported at the moment
     * @param string $body Body param:
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        string $domain,
        string $body,
        ?RequestOptions $requestOptions = null,
    ): mixed;
}
