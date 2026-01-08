<?php

declare(strict_types=1);

namespace Courier\ServiceContracts;

use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\Translations\TranslationRetrieveParams;
use Courier\Translations\TranslationUpdateParams;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
interface TranslationsRawContract
{
    /**
     * @api
     *
     * @param string $locale The locale you want to retrieve the translations for
     * @param array<string,mixed>|TranslationRetrieveParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        array|TranslationRetrieveParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;

    /**
     * @api
     *
     * @param string $locale Path param: The locale you want to retrieve the translations for
     * @param array<string,mixed>|TranslationUpdateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        array|TranslationUpdateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse;
}
