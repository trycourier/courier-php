<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\BaseClient;
use Courier\Core\Util;
use Courier\Services\AudiencesService;
use Courier\Services\AuditEventsService;
use Courier\Services\AuthService;
use Courier\Services\AutomationsService;
use Courier\Services\BrandsService;
use Courier\Services\BulkService;
use Courier\Services\InboundService;
use Courier\Services\ListsService;
use Courier\Services\MessagesService;
use Courier\Services\NotificationsService;
use Courier\Services\ProfilesService;
use Courier\Services\RequestsService;
use Courier\Services\SendService;
use Courier\Services\TenantsService;
use Courier\Services\TranslationsService;
use Courier\Services\UsersService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Courier\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Courier\RequestOptions
 */
class Client extends BaseClient
{
    public string $apiKey;

    /**
     * @api
     */
    public SendService $send;

    /**
     * @api
     */
    public AudiencesService $audiences;

    /**
     * @api
     */
    public AuditEventsService $auditEvents;

    /**
     * @api
     */
    public AuthService $auth;

    /**
     * @api
     */
    public AutomationsService $automations;

    /**
     * @api
     */
    public BrandsService $brands;

    /**
     * @api
     */
    public BulkService $bulk;

    /**
     * @api
     */
    public InboundService $inbound;

    /**
     * @api
     */
    public ListsService $lists;

    /**
     * @api
     */
    public MessagesService $messages;

    /**
     * @api
     */
    public RequestsService $requests;

    /**
     * @api
     */
    public NotificationsService $notifications;

    /**
     * @api
     */
    public ProfilesService $profiles;

    /**
     * @api
     */
    public TenantsService $tenants;

    /**
     * @api
     */
    public TranslationsService $translations;

    /**
     * @api
     */
    public UsersService $users;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $apiKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->apiKey = (string) ($apiKey ?? getenv('COURIER_API_KEY'));

        $baseUrl ??= getenv('COURIER_BASE_URL') ?: 'https://api.courier.com';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('Courier/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '4.1.0',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->send = new SendService($this);
        $this->audiences = new AudiencesService($this);
        $this->auditEvents = new AuditEventsService($this);
        $this->auth = new AuthService($this);
        $this->automations = new AutomationsService($this);
        $this->brands = new BrandsService($this);
        $this->bulk = new BulkService($this);
        $this->inbound = new InboundService($this);
        $this->lists = new ListsService($this);
        $this->messages = new MessagesService($this);
        $this->requests = new RequestsService($this);
        $this->notifications = new NotificationsService($this);
        $this->profiles = new ProfilesService($this);
        $this->tenants = new TenantsService($this);
        $this->translations = new TranslationsService($this);
        $this->users = new UsersService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return $this->apiKey ? ['Authorization' => "Bearer {$this->apiKey}"] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
