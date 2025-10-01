<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
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
     * @param string $domain
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        $domain,
        ?RequestOptions $requestOptions = null
    ): string {
        $params = ['domain' => $domain];

        return $this->retrieveRaw($locale, $params, $requestOptions);
    }

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
    ): string {
        [$parsed, $options] = TranslationRetrieveParams::parseRequest(
            $params,
            $requestOptions
        );
        $domain = $parsed['domain'];
        unset($parsed['domain']);

        // @phpstan-ignore-next-line;
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
    ): mixed {
        $params = ['domain' => $domain, 'body' => $body];

        return $this->updateRaw($locale, $params, $requestOptions);
    }

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
    ): mixed {
        [$parsed, $options] = TranslationUpdateParams::parseRequest(
            $params,
            $requestOptions
        );
        $domain = $parsed['domain'];
        unset($parsed['domain']);

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'put',
            path: ['translations/%1$s/%2$s', $domain, $locale],
            body: array_diff_key($parsed['body'], array_flip(['domain'])),
            options: $options,
            convert: null,
        );
    }
}
