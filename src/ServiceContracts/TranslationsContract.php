<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Translations\TranslationRetrieveParams;

interface TranslationsContract
{
    /**
     * @api
     *
     * @param array<mixed>|TranslationRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        array|TranslationRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): string;

    /**
     * @api
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        string $params,
        ?RequestOptions $requestOptions = null
    ): mixed;
}
