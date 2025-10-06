<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\BaseClient;
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
    public TenantsService $tenants;

    /**
     * @api
     */
    public AudiencesService $audiences;

    /**
     * @api
     */
    public BulkService $bulk;

    /**
     * @api
     */
    public UsersService $users;

    /**
     * @api
     */
    public AuditEventsService $auditEvents;

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
    public ListsService $lists;

    /**
     * @api
     */
    public MessagesService $messages;

    /**
     * @api
     */
    public NotificationsService $notifications;

    /**
     * @api
     */
    public AuthService $auth;

    /**
     * @api
     */
    public InboundService $inbound;

    /**
     * @api
     */
    public RequestsService $requests;

    /**
     * @api
     */
    public ProfilesService $profiles;

    /**
     * @api
     */
    public TranslationsService $translations;

    public function __construct(?string $apiKey = null, ?string $baseUrl = null)
    {
        $this->apiKey = (string) ($apiKey ?? getenv('COURIER_API_KEY'));

        $baseUrl ??= getenv('COURIER_BASE_URL') ?: 'https://api.courier.com';

        $options = RequestOptions::with(
            uriFactory: Psr17FactoryDiscovery::findUriFactory(),
            streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
            requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
            transporter: Psr18ClientDiscovery::find(),
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json', 'Accept' => 'application/json',
            ],
            baseUrl: $baseUrl,
            options: $options,
        );

        $this->send = new SendService($this);
        $this->tenants = new TenantsService($this);
        $this->audiences = new AudiencesService($this);
        $this->bulk = new BulkService($this);
        $this->users = new UsersService($this);
        $this->auditEvents = new AuditEventsService($this);
        $this->automations = new AutomationsService($this);
        $this->brands = new BrandsService($this);
        $this->lists = new ListsService($this);
        $this->messages = new MessagesService($this);
        $this->notifications = new NotificationsService($this);
        $this->auth = new AuthService($this);
        $this->inbound = new InboundService($this);
        $this->requests = new RequestsService($this);
        $this->profiles = new ProfilesService($this);
        $this->translations = new TranslationsService($this);
    }

    /** @return array<string, string> */
    protected function authHeaders(): array
    {
        if (!$this->apiKey) {
            return [];
        }

        return ['Authorization' => "Bearer {$this->apiKey}"];
    }
}
