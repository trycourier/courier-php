<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Translations\TranslationRetrieveParams;
use Courier\Translations\TranslationUpdateParams;

interface TranslationsRawContract
{
    /**
     * @api
     *
     * @param string $locale The locale you want to retrieve the translations for
     * @param array<mixed>|TranslationRetrieveParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        array|TranslationRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $locale Path param: The locale you want to retrieve the translations for
     * @param array<mixed>|TranslationUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        array|TranslationUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
