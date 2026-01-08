<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\Core\Util;
use Courier\RequestOptions;
use Courier\ServiceContracts\TranslationsContract;

/**
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
final class TranslationsService implements TranslationsContract
{
    /**
     * @api
     */
    public TranslationsRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new TranslationsRawService($client);
    }

    /**
     * @api
     *
     * Get translations by locale
     *
     * @param string $locale The locale you want to retrieve the translations for
     * @param string $domain The domain you want to retrieve translations for. Only `default` is supported at the moment
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        string $domain,
        RequestOptions|array|null $requestOptions = null,
    ): string {
        $params = Util::removeNulls(['domain' => $domain]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->retrieve($locale, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }

    /**
     * @api
     *
     * Update a translation
     *
     * @param string $locale Path param: The locale you want to retrieve the translations for
     * @param string $domain Path param: The domain you want to retrieve translations for. Only `default` is supported at the moment
     * @param string $body Body param:
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        string $domain,
        string $body,
        RequestOptions|array|null $requestOptions = null,
    ): mixed {
        $params = Util::removeNulls(['domain' => $domain, 'body' => $body]);

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($locale, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
