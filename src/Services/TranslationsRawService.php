<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\TranslationsRawContract;
use Courier\Translations\TranslationRetrieveParams;
use Courier\Translations\TranslationUpdateParams;

final class TranslationsRawService implements TranslationsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get translations by locale
     *
     * @param string $locale The locale you want to retrieve the translations for
     * @param array{domain: string}|TranslationRetrieveParams $params
     *
     * @return BaseResponse<string>
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        array|TranslationRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranslationRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $domain = $parsed['domain'];
        unset($parsed['domain']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['translations/%1$s/%2$s', $domain, $locale],
            options: $options,
            convert: 'string',
        );
    }

    /**
     * @api
     *
     * Update a translation
     *
     * @param string $locale Path param: The locale you want to retrieve the translations for
     * @param array{domain: string, body: string}|TranslationUpdateParams $params
     *
     * @return BaseResponse<mixed>
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        array|TranslationUpdateParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TranslationUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $domain = $parsed['domain'];
        unset($parsed['domain']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'put',
            path: ['translations/%1$s/%2$s', $domain, $locale],
            body: array_diff_key($parsed['body'], ['domain']),
            options: $options,
            convert: null,
        );
    }
}
