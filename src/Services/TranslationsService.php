<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Contracts\BaseResponse;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\TranslationsContract;
use Courier\Translations\TranslationRetrieveParams;
use Courier\Translations\TranslationUpdateParams;

final class TranslationsService implements TranslationsContract
{
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Get translations by locale
     *
     * @param array{domain: string}|TranslationRetrieveParams $params
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        array|TranslationRetrieveParams $params,
        ?RequestOptions $requestOptions = null,
    ): string {
        [$parsed, $options] = TranslationRetrieveParams::parseRequest(
            $params,
            $requestOptions,
        );
        $domain = $parsed['domain'];
        unset($parsed['domain']);

        /** @var BaseResponse<string> */
        $response = $this->client->request(
            method: 'get',
            path: ['translations/%1$s/%2$s', $domain, $locale],
            options: $options,
            convert: 'string',
        );

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a translation
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        string $params,
        ?RequestOptions $requestOptions = null
    ): mixed {
        [$parsed, $options] = TranslationUpdateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $domain = $parsed['domain'];
        unset($parsed['domain']);

        /** @var BaseResponse<mixed> */
        $response = $this->client->request(
            method: 'put',
            path: ['translations/%1$s/%2$s', $domain, $locale],
            body: array_diff_key($parsed['body'], ['domain']),
            options: $options,
            convert: null,
        );

        return $response->parse();
    }
}
