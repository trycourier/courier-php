<?php

namespace Courier;

use Courier\Audiences\AudiencesClient;
use Courier\AuditEvents\AuditEventsClient;
use Courier\AuthTokens\AuthTokensClient;
use Courier\Automations\AutomationsClient;
use Courier\Brands\BrandsClient;
use Courier\Bulk\BulkClient;
use Courier\Inbound\InboundClient;
use Courier\Lists\ListsClient;
use Courier\Messages\MessagesClient;
use Courier\Notifications\NotificationsClient;
use Courier\Profiles\ProfilesClient;
use Courier\Templates\TemplatesClient;
use Courier\Tenants\TenantsClient;
use Courier\Translations\TranslationsClient;
use Courier\Users\UsersClient;
use GuzzleHttp\ClientInterface;
use Courier\Core\Client\RawClient;
use Courier\Requests\SendMessageRequest;
use Courier\Types\SendMessageResponse;
use Courier\Exceptions\CourierException;
use Courier\Exceptions\CourierApiException;
use Courier\Core\Json\JsonApiRequest;
use Courier\Core\Client\HttpMethod;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Exception;

class CourierClient
{
    /**
     * @var AudiencesClient $audiences
     */
    public AudiencesClient $audiences;

    /**
     * @var AuditEventsClient $auditEvents
     */
    public AuditEventsClient $auditEvents;

    /**
     * @var AuthTokensClient $authTokens
     */
    public AuthTokensClient $authTokens;

    /**
     * @var AutomationsClient $automations
     */
    public AutomationsClient $automations;

    /**
     * @var BrandsClient $brands
     */
    public BrandsClient $brands;

    /**
     * @var BulkClient $bulk
     */
    public BulkClient $bulk;

    /**
     * @var InboundClient $inbound
     */
    public InboundClient $inbound;

    /**
     * @var ListsClient $lists
     */
    public ListsClient $lists;

    /**
     * @var MessagesClient $messages
     */
    public MessagesClient $messages;

    /**
     * @var NotificationsClient $notifications
     */
    public NotificationsClient $notifications;

    /**
     * @var ProfilesClient $profiles
     */
    public ProfilesClient $profiles;

    /**
     * @var TemplatesClient $templates
     */
    public TemplatesClient $templates;

    /**
     * @var TenantsClient $tenants
     */
    public TenantsClient $tenants;

    /**
     * @var TranslationsClient $translations
     */
    public TranslationsClient $translations;

    /**
     * @var UsersClient $users
     */
    public UsersClient $users;

    /**
     * @var ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   headers?: array<string, string>,
     * } $options
     */
    private ?array $options;

    /**
     * @var RawClient $client
     */
    private RawClient $client;

    /**
     * @param ?string $authorizationToken The authorizationToken to use for authentication.
     * @param ?array{
     *   baseUrl?: string,
     *   client?: ClientInterface,
     *   headers?: array<string, string>,
     * } $options
     */
    public function __construct(
        ?string $authorizationToken = null,
        ?array $options = null,
    ) {
        $authorizationToken ??= $this->getFromEnvOrThrow('COURIER_AUTH_TOKEN', 'Please pass in authorizationToken or set the environment variable COURIER_AUTH_TOKEN.');
        $defaultHeaders = [
            'Authorization' => "Bearer $authorizationToken",
            'X-Fern-Language' => 'PHP',
            'X-Fern-SDK-Name' => 'Courier',
            'X-Fern-SDK-Version' => '1.13.0',
        ];

        $this->options = $options ?? [];
        $this->options['headers'] = array_merge(
            $defaultHeaders,
            $this->options['headers'] ?? [],
        );

        $this->client = new RawClient(
            options: $this->options,
        );

        $this->audiences = new AudiencesClient($this->client);
        $this->auditEvents = new AuditEventsClient($this->client);
        $this->authTokens = new AuthTokensClient($this->client);
        $this->automations = new AutomationsClient($this->client);
        $this->brands = new BrandsClient($this->client);
        $this->bulk = new BulkClient($this->client);
        $this->inbound = new InboundClient($this->client);
        $this->lists = new ListsClient($this->client);
        $this->messages = new MessagesClient($this->client);
        $this->notifications = new NotificationsClient($this->client);
        $this->profiles = new ProfilesClient($this->client);
        $this->templates = new TemplatesClient($this->client);
        $this->tenants = new TenantsClient($this->client);
        $this->translations = new TranslationsClient($this->client);
        $this->users = new UsersClient($this->client);
    }

    /**
     * Use the send API to send a message to one or more recipients.
     *
     * @param SendMessageRequest $request
     * @param ?array{
     *   baseUrl?: string,
     * } $options
     * @return SendMessageResponse
     * @throws CourierException
     * @throws CourierApiException
     */
    public function send(SendMessageRequest $request, ?array $options = null): SendMessageResponse
    {
        try {
            $response = $this->client->sendRequest(
                new JsonApiRequest(
                    baseUrl: $options['baseUrl'] ?? $this->client->options['baseUrl'] ?? Environments::Production->value,
                    path: "/send",
                    method: HttpMethod::POST,
                    body: $request,
                ),
            );
            $statusCode = $response->getStatusCode();
            if ($statusCode >= 200 && $statusCode < 400) {
                $json = $response->getBody()->getContents();
                return SendMessageResponse::fromJson($json);
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
     * @param string $env
     * @param string $message
     * @return string
     */
    private function getFromEnvOrThrow(string $env, string $message): string
    {
        $value = getenv($env);
        return $value ? (string) $value : throw new Exception($message);
    }
}
