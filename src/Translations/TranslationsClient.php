<?php

namespace Courier\Translations;

use Courier\Core\Client\RawClient;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Environments;
use Courier\Core\Client\HttpMethod;
use Courier\Core\Json\JsonDecoder;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;

class TranslationsClient
{
    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param RawClient $client
     */
    public function __construct(
        RawClient $client,
    ) {
        $this->client = $client;
    }

    /**
     * Get translations by locale
     *
     * @param string $domain The domain you want to retrieve translations for. Only `default` is supported at the moment
     * @param string $locale The locale you want to retrieve the translations for
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return string
     * @throws CourierException
     * @throws CourierApiException
     */
    public function get(string $domain, string $locale, ?array $options = null): string
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/translations/$domain/$locale",
                    method: HttpMethod::GET,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return JsonDecoder::decodeString($json);
            }
        } catch (JsonException $e) {
            throw new CourierException(message: "Failed to deserialize response: {$e->getMessage()}", previous: $e);
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }

    /**
     * Update a translation
     *
     * @param string $domain The domain you want to retrieve translations for. Only `default` is supported at the moment
     * @param string $locale The locale you want to retrieve the translations for
     * @param string $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @throws CourierException
     * @throws CourierApiException
     */
    public function update(string $domain, string $locale, string $request, ?array $options = null): void
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/translations/$domain/$locale",
                    method: HttpMethod::PUT,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                return;
            }
        } catch (ClientExceptionInterface $e) {
            throw new CourierException(message: $e->getMessage(), previous: $e);
        }
        throw new CourierApiException(
            message: 'API request failed',
            statusCode: $statusCode,
            body: $response->getBody()->getContents(),
        );
    }
}
