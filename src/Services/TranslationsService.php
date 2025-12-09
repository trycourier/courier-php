<?php

declare(strict_types=1);

namespace Courier\Services;

use Courier\Client;
use Courier\Core\Exceptions\APIException;
use Courier\RequestOptions;
use Courier\ServiceContracts\TranslationsContract;

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
     *
     * @throws APIException
     */
    public function retrieve(
        string $locale,
        string $domain,
        ?RequestOptions $requestOptions = null
    ): string {
        $params = ['domain' => $domain];

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
     *
     * @throws APIException
     */
    public function update(
        string $locale,
        string $domain,
        string $body,
        ?RequestOptions $requestOptions = null,
    ): mixed {
        $params = ['domain' => $domain, 'body' => $body];

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->update($locale, params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
