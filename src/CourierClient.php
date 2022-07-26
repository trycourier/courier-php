<?php

namespace Courier;

use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;

final class CourierClient implements CourierClientInterface
{
    /**
     * @var string Library version, used for setting User-Agent
     */
    private $version = '1.9.0';

    /**
     * Courier API base url.
     *
     * @var string
     */
    private $base_url = "https://api.courier.com/";

    /**
     * Courier authorization token.
     *
     * @var string
     */
    private $auth_token;

    /**
     * Courier username.
     *
     * @var string
     */
    private $username;

    /**
     * Courier password.
     *
     * @var string
     */
    private $password;

    /**
     * Courier authorization header.
     *
     * @var array
     */
    private $authorization;

    /**
     * PSR-18 ClientInterface instance.
     *
     * @var ClientInterface|null
     */
    private $httpClient;

    /**
     * Courier client constructor.
     *
     * @param string|null $base_url
     * @param string|null $auth_token
     * @param string|null $username
     * @param string|null $password
     */
    public function __construct(string $base_url = null, string $auth_token = null, string $username = null, string $password = null)
    {
        # Override base_url if passed as a param or set as an environment variable
        $this->base_url = $base_url ?: getenv('COURIER_BASE_URL') ?:  $this->base_url;

        # Token Auth takes precedence; If no token auth, then Basic Auth
        if ($auth_token) {
            $this->auth_token = $auth_token;
            $this->authorization = [
                'type' => 'Bearer',
                'token' => $this->auth_token,
            ];
        } else if (getenv('COURIER_AUTH_TOKEN')) {
            $this->auth_token = getenv('COURIER_AUTH_TOKEN') ?: '';
            $this->authorization = [
                'type' => 'Bearer',
                'token' => $this->auth_token,
            ];
        } else if ($username and $password) {
            $this->username = $username;
            $this->password = $password;
            $this->authorization = [
                'type' => 'Basic',
                'token' => base64_encode("$this->username:$this->password"),
            ];
        } else if (getenv('COURIER_AUTH_USERNAME') and getenv('COURIER_AUTH_PASSWORD')) {
            $this->username = getenv('COURIER_AUTH_USERNAME') ?: '';
            $this->password = getenv('COURIER_AUTH_PASSWORD') ?: '';
            $this->authorization = [
                'type' => 'Basic',
                'token' => base64_encode("$this->username:$this->password"),
            ];
        }
    }

    /**
     * Get the current authorization header.
     *
     * @return string
     */
    protected function getAuthorizationHeader(): string
    {
        return $this->authorization['type'] . ' ' . $this->authorization['token'];
    }

    /**
     * Set the HTTP client to use.
     *
     * @param ClientInterface $clientInterface
     * @return void
     */
    public function setHttpClient(ClientInterface $clientInterface): void
    {
        $this->httpClient = $clientInterface;
    }

    /**
     * Get the HTTP Client interface.
     *
     * @return ClientInterface
     */
    private function getHttpClient(): ClientInterface
    {
        return $this->httpClient ?: Psr18ClientDiscovery::find();
    }

    /**
     * Process the request and decode response as JSON.
     *
     * @param RequestInterface $request
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    private function doRequest(RequestInterface $request): object
    {
        $response = $this->getHttpClient()->sendRequest($request);

        if( $response->getStatusCode() < 200 || $response->getStatusCode() >= 300 ){
            throw new CourierRequestException($response);
        }

        return \json_decode($response->getBody()->getContents());
	}

    /**
     * Build a PSR-7 Request instance.
     *
     * @param string $method
     * @param string $path
     * @param array $params
     * @return RequestInterface
     */
    private function buildRequest(string $method, string $path, array $params = []): RequestInterface
    {
        return Psr17FactoryDiscovery::findRequestFactory()
            ->createRequest($method, $this->base_url . $path)
            ->withHeader("Authorization", $this->getAuthorizationHeader())
            ->withHeader("Content-Type", "application/json")
            ->withHeader("User-Agent", "courier-php/$this->version")
            ->withBody(
                Psr17FactoryDiscovery::findStreamFactory()
                    ->createStream(json_encode($params))
            );
    }

    /**
     * Build a PSR-7 Request instance with Idempotency Key.
     *
     * @param string $method
     * @param string $path
     * @param array $params
     * @param string $idempotency_key
     * @return RequestInterface
     */
    private function buildIdempotentRequest(string $method, string $path, array $params = [], string $idempotency_key = ''): RequestInterface
    {
        return Psr17FactoryDiscovery::findRequestFactory()
            ->createRequest($method, $this->base_url . $path)
            ->withHeader("Authorization", $this->getAuthorizationHeader())
            ->withHeader("Content-Type", "application/json")
            ->withHeader("User-Agent", "courier-php/$this->version")
            ->withHeader("Idempotency-Key", $idempotency_key)
            ->withBody(
                Psr17FactoryDiscovery::findStreamFactory()
                    ->createStream(json_encode($params))
            );
    }

    /**
     * Send a notification to a specified recipient.
     *
     * @param string $event
     * @param string $recipient
     * @param string|null $brand
     * @param object|null $profile
     * @param object|null $data
     * @param object|null $preferences
     * @param object|null $override
     * @param string|null $idempotency_key
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function sendNotification(string $event, string $recipient, string $brand = null, object $profile = null, object $data = null, object $preferences = null, object $override = null, string $idempotency_key = null): object
    {
        $params = array(
            'event' => $event,
            'recipient' => $recipient,
            'brand' => $brand,
            'profile' => $profile,
            'data' => $data,
            'preferences' => $preferences,
            'override' => $override
        );

        $params = array_filter($params);

        return $this->doRequest(
            $idempotency_key ? $this->buildIdempotentRequest("post", "send", $params, $idempotency_key)
            : $this->buildRequest("post", "send", $params)
        );
    }

    /**
     * Send an enhanced notification
     *
     * @param object $message
     * @param string|null $idempotency_key
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function sendEnhancedNotification(object $message, string $idempotency_key = null): object
    {
        $params = array(
            'message' => $message
        );

        $params = array_filter($params);

        return $this->doRequest(
            $idempotency_key ? $this->buildIdempotentRequest("post", "send", $params, $idempotency_key)
            : $this->buildRequest("post", "send", $params)
        );
    }

    /**
     * Send a notification to list(s) subscribers
     *
     * @param string $event
     * @param string|null $list
     * @param string|null $pattern
     * @param string|null $brand
     * @param object|null $data
     * @param object|null $override
     * @param string|null $idempotency_key
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function sendNotificationToList(string $event, string $list = null, string $pattern = null, string $brand = null, object $data = null, object $override = null, string $idempotency_key = null): object
    {
        if ((!$list and !$pattern) or ($list and $pattern)) {
            throw new CourierException("list.send requires a list id or a pattern");
        }

        $params = array(
            'event' => $event,
            'list' => $list,
            'pattern' => $pattern,
            'brand' => $brand,
            'data' => $data,
            'override' => $override
        );

        $params = array_filter($params);

        return $this->doRequest(
            $idempotency_key ? $this->buildIdempotentRequest("post", "send/list", $params, $idempotency_key)
            : $this->buildRequest("post", "send/list", $params)
        );
    }

    /**
     *  Fetch the statuses of messages you've previously sent.
     *
     * @param string|null $cursor
     * @param string|null $event
     * @param string|null $list
     * @param string|null $message_id
     * @param string|null $notification
     * @param string|null $recipient
     * @return object
     * @throws CourierRequestException
     */
    public function getMessages(string $cursor = null, string $event = null, string $list = null, string $message_id = null, string $notification = null, string $recipient = null): object
    {
        $query_params = array(
            'cursor' => $cursor,
            'event' => $event,
            'list' => $list,
            'message_id' => $message_id,
            'notification' => $notification,
            'recipient' => $recipient
        );

        return $this->doRequest(
            $this->buildRequest("get", "messages?" . http_build_query($query_params, '', '&', PHP_QUERY_RFC3986))
        );
    }

    /**
     *  Fetch the status of a message you've previously sent.
     *
     * @param string $message_id
     * @return object
     * @throws CourierRequestException
     */
    public function getMessage(string $message_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "messages/" . $message_id)
        );
    }

    /**
     *  Fetch the array of events of a message you've previously sent.
     *
     * @param string $message_id
     * @param string|null $type
     * @return object
     * @throws CourierRequestException
     */
    public function getMessageHistory(string $message_id, string $type = null): object
    {
        $path = "messages/" . $message_id . "/history";

        if ($type) {
            $path = $path . "?type=" . $type;
        }

        return $this->doRequest(
            $this->buildRequest("get", $path)
        );
    }

    /**
     *  Get the list of lists
     * @param string|null $cursor
     * @param string|null $pattern
     * @return object
     * @throws CourierRequestException
     */
    public function getLists(string $cursor = null, string $pattern = null): object
    {
        $query_params = array(
            'cursor' => $cursor,
            'pattern' => $pattern
        );

        return $this->doRequest(
            $this->buildRequest("get", "lists?" . http_build_query($query_params, '', '&', PHP_QUERY_RFC3986))
        );
    }

    /**
     *  Get the list items.
     *
     * @param string $list_id
     * @return object
     * @throws CourierRequestException
     */
    public function getList(string $list_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "lists/" . $list_id)
        );
    }

    /**
     *  Create or replace an existing list with the supplied values.
     *
     * @param string $list_id
     * @param string $name
     * @return object
     * @throws CourierRequestException
     */
    public function putList(string $list_id, string $name): object
    {
        $params = array(
            'name' => $name
        );

        return $this->doRequest(
            $this->buildRequest("put", "lists/" . $list_id, $params)
        );
    }

    /**
     *  Delete a list by list ID.
     *
     * @param string $list_id
     * @return object
     * @throws CourierRequestException
     */
    public function deleteList(string $list_id): object
    {
        return $this->doRequest(
            $this->buildRequest("delete", "lists/" . $list_id)
        );
    }

    /**
     *  Restore an existing list.
     *
     * @param string $list_id
     * @return object
     * @throws CourierRequestException
     */
    public function restoreList(string $list_id): object
    {
        return $this->doRequest(
            $this->buildRequest("put", "lists/" . $list_id . "/restore")
        );
    }

    /**
     *  Get the list's subscriptions
     *
     * @param string $list_id
     * @param string|null $cursor
     * @return object
     * @throws CourierRequestException
     */
    public function getListSubscriptions(string $list_id, string $cursor = null): object
    {
        $path = "lists/" . $list_id . "/subscriptions";

        if ($cursor) {
            $path = $path . "?cursor=" . $cursor;
        }

        return $this->doRequest(
            $this->buildRequest("get", $path)
        );
    }

    /**
     *  Subscribe multiple recipients to a list (note: if the List does not exist, it will be automatically created)
     *
     * @param string $list_id
     * @param array $recipients
     * @return object
     * @throws CourierRequestException
     */
    public function subscribeMultipleRecipientsToList(string $list_id, array $recipients): object
    {
        $params = array(
            'recipients' => $recipients
        );

        return $this->doRequest(
            $this->buildRequest("put", "lists/" . $list_id . "/subscriptions", $params)
        );
    }

    /**
     *  Subscribe a recipient to an existing list (note: if the List does not exist, it will be automatically created).
     *
     * @param string $list_id
     * @param string $recipient_id
     * @return object
     * @throws CourierRequestException
     */
    public function subscribeRecipientToList(string $list_id, string $recipient_id): object
    {
        return $this->doRequest(
            $this->buildRequest("put", "lists/" . $list_id . "/" . "subscriptions/" . $recipient_id)
        );
    }

    /**
     *  Delete a subscription to a list by list and recipient ID.
     *
     * @param string $list_id
     * @param string $recipient_id
     * @return object
     * @throws CourierRequestException
     */
    public function deleteListSubscription(string $list_id, string $recipient_id): object
    {
        return $this->doRequest(
            $this->buildRequest("delete", "lists/" . $list_id . "/" . "subscriptions/" . $recipient_id)
        );
    }

    /**
     *  Get the list of brands
     * @param string|null $cursor
     * @return object
     * @throws CourierRequestException
     */
    public function getBrands(string $cursor = null): object
    {
        $query_params = array(
            'cursor' => $cursor
        );

        return $this->doRequest(
            $this->buildRequest("get", "brands?" . http_build_query($query_params, '', '&', PHP_QUERY_RFC3986))
        );
    }

    /**
     * Create a new brand
     *
     * @param string|null $id
     * @param string $name
     * @param object $settings
     * @param object|null $snippets
     * @param string|null $idempotency_key
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function createBrand(string $id = null, string $name, object $settings, object $snippets = null, string $idempotency_key = null): object
    {
        $params = array(
            'id' => $id,
            'name' => $name,
            'settings' => $settings,
            'snippets' => $snippets
        );

        $params = array_filter($params);

        return $this->doRequest(
            $idempotency_key ? $this->buildIdempotentRequest("post", "brands", $params, $idempotency_key)
            : $this->buildRequest("post", "brands", $params)
        );
    }

    /**
     *  Fetch a specific brand by brand ID.
     *
     * @param string $brand_id
     * @return object
     * @throws CourierRequestException
     */
    public function getBrand(string $brand_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "brands/" . $brand_id)
        );
    }

    /**
     *  Replace an existing brand with the supplied values.
     *
     * @param string $brand_id
     * @param string $name
     * @param object $settings
     * @param object|null $snippets
     * @return object
     * @throws CourierRequestException
     */
    public function replaceBrand(string $brand_id, string $name, object $settings, object $snippets = null): object
    {
        $params = array(
            'name' => $name,
            'settings' => $settings,
            'snippets' => $snippets
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("put", "brands/" . $brand_id, $params)
        );
    }

    /**
     *  Delete a brand by brand ID.
     *
     * @param string $brand_id
     * @return object
     * @throws CourierRequestException
     */
    public function deleteBrand(string $brand_id): object
    {
        return $this->doRequest(
            $this->buildRequest("delete", "brands/" . $brand_id)
        );
    }

    /**
     *  Fetch the list of events
     * @return object
     * @throws CourierRequestException
     */
    public function getEvents(): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "events")
        );
    }

    /**
     *  Fetch a specific event by event ID.
     *
     * @param string $event_id
     * @return object
     * @throws CourierRequestException
     */
    public function getEvent(string $event_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "events/" . $event_id)
        );
    }

    /**
     *  Replace an existing event with the supplied values or create a new event if one does not already exist.
     *
     * @param string $event_id
     * @param string $id
     * @param string $type
     * @return object
     * @throws CourierRequestException
     */
    public function putEvent(string $event_id, string $id, string $type): object
    {
        $params = array(
            'id' => $id,
            'type' => $type
        );

        return $this->doRequest(
            $this->buildRequest("put", "events/" . $event_id, $params)
        );
    }

    /**
     *  Get the profile stored under the specified recipient ID.
     *
     * @param string $recipient_id
     * @return object
     * @throws CourierRequestException
     */
    public function getProfile(string $recipient_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "profiles/" . $recipient_id)
        );
    }

    /**
     *  Merge the supplied values with an existing profile or
     *  create a new profile if one doesn't already exist.
     *
     * @param string $recipient_id
     * @param object $profile
     * @return object
     * @throws CourierRequestException
     */
    public function upsertProfile(string $recipient_id, object $profile = null): object
    {
        return $this->doRequest(
            $this->buildRequest("post", "profiles/" . $recipient_id, array('profile' => $profile))
        );
    }

    /**
     *  Apply a JSON Patch (RFC 6902) to the specified profile or
     *  create one if a profile doesn't already exist.
     *
     * @param string $recipient_id
     * @param array $patch
     * @return object
     * @throws CourierRequestException
     */
    public function patchProfile(string $recipient_id, array $patch): object
    {
        return $this->doRequest(
            $this->buildRequest("patch", "profiles/" . $recipient_id, array('patch' => $patch))
        );
    }

    /**
     *  Replace an existing profile with the supplied values or
     *  create a new profile if one does not already exist.
     *
     * @param string $recipient_id
     * @param object $profile
     * @return object
     * @throws CourierRequestException
     */
    public function replaceProfile(string $recipient_id, object $profile = null): object
    {
        return $this->doRequest(
            $this->buildRequest("put", "profiles/" . $recipient_id, array('profile' => $profile))
        );
    }

    /**
     *  Get the subscribed lists for a specified recipient Profile.
     *
     * @param string $recipient_id
     * @param string|null $cursor
     * @return object
     * @throws CourierRequestException
     */
    public function getProfileLists(string $recipient_id, string $cursor = null): object
    {
        $path = "profiles/" . $recipient_id . "/lists";

        if ($cursor) {
            $path = $path . "?cursor=" . $cursor;
        }

        return $this->doRequest(
            $this->buildRequest("get", $path)
        );
    }

    /**
     *  Replace an existing set of preferences with the supplied
     *  values or create a new set of preferences if they do not already exist.
     *
     * @param string $recipient_id
     * @param string $preferred_channel
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function getPreferences(string $recipient_id, string $preferred_channel): object
    {

        return $this->doRequest(
            $this->buildRequest("get", "preferences/" . $recipient_id, array('preferred_channel' => $preferred_channel))
        );
    }

    /**
     *  Replace an existing set of preferences with the supplied
     *  values or create a new set of preferences if they do not already exist.
     *
     * @param string $recipient_id
     * @param string $preferred_channel
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function updatePreferences(string $recipient_id, string $preferred_channel): object
    {

        return $this->doRequest(
            $this->buildRequest("put", "preferences/" . $recipient_id, array('preferred_channel' => $preferred_channel))
        );
    }

    /**
     *  List of notifications
     * @param string|null $cursor
     * @return object
     * @throws CourierRequestException
     */
    public function listNotifications(string $cursor = null): object
    {
        $query_params = array(
            'cursor' => $cursor
        );

        return $this->doRequest(
            $this->buildRequest("get", "notifications?" . http_build_query($query_params, '', '&', PHP_QUERY_RFC3986))
        );
    }

    /**
     *  Get notification content
     *
     * @param string $id
     * @return object
     * @throws CourierRequestException
     */
    public function getNotificationContent(string $id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "notifications/" . $id . "/content")
        );
    }

    /**
     *  Get notification draft content
     *
     * @param string $id
     * @return object
     * @throws CourierRequestException
     */
    public function getNotificationDraftContent(string $id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "notifications/" . $id . "/draft/content")
        );
    }

    /**
     * Post notification variations
     *
     * @param string $id
     * @param array $blocks
     * @param array|null $channels
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function postNotificationVariations(string $id, array $blocks, array $channels = null): object
    {
        $params = array(
            'blocks' => $blocks,
            'channels' => $channels
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("post", "notifications/" . $id . "/variations", $params)
        );
    }

    /**
     * Post notification draft variations
     *
     * @param string $id
     * @param array $blocks
     * @param array|null $channels
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function postNotificationDraftVariations(string $id, array $blocks, array $channels = null): object
    {
        $params = array(
            'blocks' => $blocks,
            'channels' => $channels
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("post", "notifications/" . $id . "/draft/variations", $params)
        );
    }

    /**
     *  Get notification submission checks
     *
     * @param string $id
     * @param string $submissionId
     * @return object
     * @throws CourierRequestException
     */
    public function getNotificationSubmissionChecks(string $id, string $submission_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "notifications/" . $id . "/" . $submission_id . "/checks")
        );
    }

    /**
     *  Put notification submission checks
     *
     * @param string $id
     * @param string $submissionId
     * @param array $checks
     * @return object
     * @throws CourierRequestException
     */
    public function putNotificationSubmissionChecks(string $id, string $submission_id, array $checks): object
    {
        $params = array(
            'checks' => $checks
        );
        return $this->doRequest(
            $this->buildRequest("put", "notifications/" . $id . "/" . $submission_id . "/checks", $params)
        );
    }

    /**
     *  Cancel notification submission
     *
     * @param string $id
     * @param string $submissionId
     * @return object
     * @throws CourierRequestException
     */
    public function deleteNotificationSubmission(string $id, string $submission_id): object
    {
        return $this->doRequest(
            $this->buildRequest("delete", "notifications/" . $id . "/" . $submission_id . "/checks")
        );
    }

    /**
     *  Invoke an ad hoc automation run.
     *
     * @param object automation Automations object
     * @param string|null $brand A unique identifier that represents the brand that should be used for rendering the notification
     * @param string|null $template A unique identifier that can be mapped to an individual Notification
     * @param string|null $recipient A unique identifier associated with the recipient of the delivered message
     * @param object|null $data An object that includes any data you want to pass to a message template. The data will populate the corresponding template variables
     * @param object|null $profile An object that includes any key-value pairs required by your chosen Integrations
     * @return object { "runId": string }
     * @throws CourierRequestException
     */
    public function invokeAutomation(object $automation, string $brand = null, string $template = null, string $recipient = null, object $data = null, object $profile = null): object
    {
        $params = array(
            'automation' => $automation,
            'brand' => $brand,
            'template' => $template,
            'recipient' => $recipient,
            'data' => $data,
            'profile' => $profile
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("post", "automations/invoke", $params)
        );
    }

    /**
     *  Invoke an automation run from an automation template.
     *
     * @param string templateId A unique identifier representing the automation template to be invoked.
     * @param string|null $brand A unique identifier that represents the brand that should be used for rendering the notification
     * @param object|null $data An object that includes any data you want to pass to a message template. The data will populate the corresponding template variables
     * @param object|null $profile An object that includes any key-value pairs required by your chosen Integrations
     * @param string|null $recipient A unique identifier associated with the recipient of the delivered message
     * @param string|null $template A unique identifier that can be mapped to an individual Notification
     * @return object { "runId": string }
     * @throws CourierRequestException
     */
    public function invokeAutomationFromTemplate(string $template_id, string $brand = null,  object $data = null, object $profile = null, string $recipient = null, string $template = null): object
    {
        $params = array(
            'brand' => $brand,
            'data' => $data,
            'profile' => $profile,
            'recipient' => $recipient,
            'template' => $template
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("post", "automations/" . $template_id . "/invoke", $params)
        );
    }

    /**
     *  Get an automation run
     *
     * @param string $runId A unique identifier representing the automation run.
     * @return object
     * @throws CourierRequestException
     */
    public function getAutomationRun(string $run_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "automations/runs/" . $run_id)
        );
    }

    /**
     *  Create a bulk job
     *
     * @param object message Bulk job message input object
     * @return object { "jobId": string }
     * @throws CourierRequestException
     */
    public function createBulkJob(object $message): object
    {
        $params = array(
            'message' => $message
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("post", "bulk", $params)
        );
    }

    /**
     *  Ingest into a bulk job (for now, only users)
     *
     * @param string jobId Bulk job id
     * @param array users Users to be ingested into the Bulk job
     * @return object
     * @throws CourierRequestException
     */
    public function ingestBulkJob(string $job_id, array $users): object
    {
        $params = array(
            'users' => $users
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("post", "bulk/" . $job_id, $params)
        );
    }

    /**
     *  Run a bulk job
     *
     * @param string jobId Bulk job id
     * @return object
     * @throws CourierRequestException
     */
    public function runBulkJob(string $jobId): object
    {
        return $this->doRequest(
            $this->buildRequest("post", "bulk/" . $jobId . "/run")
        );
    }

    /**
     *  Get bulk job
     *
     * @param string jobId Bulk job id
     * @return object
     * @throws CourierRequestException
     */
    public function getBulkJob(string $jobId): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "bulk/" . $jobId)
        );
    }

    /**
     *  Get bulk job users
     *
     * @param string jobId Bulk job id
     * @return object
     * @throws CourierRequestException
     */
    public function getBulkJobUsers(string $jobId): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "bulk/" . $jobId . "/users")
        );
    }

    /**
     *  Create or update an existing audience
     * @param string audienceId A unique identifier representing the audience.
     * @param object audience input object
     * @return object { "audience": object }
     * @throws CourierRequestException
     */
    public function putAudience(string $audienceId, object $audience): object
    {
        $params = array(
            'audience' => $audience
        );

        $params = array_filter($params);

        return $this->doRequest(
            $this->buildRequest("put", "audiences/" . $audienceId, $params)
        );
    }
    /**
     *  Get list of audiences in your workspace
     * @param string audienceId A unique identifier representing the audience.
     * @return object
     * @throws CourierRequestException
     */
    public function getAudience(string $audienceId): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "audiences/" . $audienceId)
        );
    }
    /**
     *  Get list of audiences in your workspace
     * @param string audienceId A unique identifier representing the audience.
     * @return object
     * @throws CourierRequestException
     */
    public function getAudienceMembers(string $audienceId): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "audiences/" . $audienceId . "/members")
        );
    }

    /**
     *  Get list of audiences in your workspace
     *
     * @return object
     * @throws CourierRequestException
     */
    public function getAudiences(): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "audiences")
        );
    }

    /**
     * Associate a group of tokens with the supplied $user_id. Will overwrite any existing tokens associated with that user.
     * @param string user_id
     * @param array tokens { "token": string, "provider_key": string }[]
     * @return object
     * @throws CourierRequestException
     */
    public function putUserTokens(string $user_id, array $tokens): object
    {
        return $this->doRequest(
            $this->buildRequest("put", "users/" . $user_id . "/tokens", $tokens)
        );
    }

    /**
     * Associate a token with the supplied &user_id. If token exists it's value will be replaced
     * with the passed body, otherwise the token will be created.
     * @param string user_id
     * @param array token { "token": string, "provider_key": string }
     * @return object
     * @throws CourierRequestException
     */
    public function putUserToken(string $user_id, array $token): object
    {
        return $this->doRequest(
            $this->buildRequest("put", "users/" . $user_id . "/tokens/" . $token["token"], $token)
        );
    }

    /**
     * Apply a JSON Patch (RFC 6902) to the specified token.
     * @param string user_id
     * @param string token - The full token string
     * @param array patch See https://www.courier.com/docs/reference/token-management/patch-token/ for more info
     * @return object
     * @throws CourierRequestException
     */
    public function patchUserToken(string $user_id, string $token, array $patch): object
    {
        return $this->doRequest(
            $this->buildRequest("patch", "users/" . $user_id . "/tokens/" . $token, $patch)
        );
    }

    /**
     * Returns data associated with a token including token status.
     * @param string user_id
     * @param string token - The full token string
     * @param array patch See https://www.courier.com/docs/reference/token-management/patch-token/ for more info
     * @return object
     * @throws CourierRequestException
     */
    public function getUserToken(string $user_id, string $token): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "users/" . $user_id . "/tokens/" . $token)
        );
    }

    /**
     * Get the tokens associated with a user
     * @param string user_id
     * @param string token - The full token string
     * @param array patch See https://www.courier.com/docs/reference/token-management/patch-token/ for more info
     * @return object
     * @throws CourierRequestException
     */
    public function getUserTokens(string $user_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "users/" . $user_id . "/tokens")
        );
    }

    /**
     * Returns a specific audit event object
     * @param string audit_event_id
     * @return object
     * @throws CourierRequestException
     */
    public function getAuditEvent(string $audit_event_id): object
    {
        return $this->doRequest(
            $this->buildRequest("get", "audit-events/" . $audit_event_id)
        );
    }

    /**
     * Returns a list of audit events
     * @param string|null $cursor
     * @return object
     * @throws CourierRequestException
     */
    public function listAuditEvents(string $cursor = null): object
    {
        $query_params = array(
            'cursor' => $cursor
        );

        return $this->doRequest(
            $this->buildRequest("get", "audit-events?" . http_build_query($query_params, '', '&', PHP_QUERY_RFC3986))
        );
    }
}
