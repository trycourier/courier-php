<?php

namespace Courier;

use Capsule\Request;
use DateTime;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Shuttle\Shuttle;

final class Courier
{
    /**
     * @var string Library version, used for setting User-Agent
     */
    private $version = '0.1.0';

    /**
     * Courier API host name.
     *
     * @var string
     */
    private $host_name = "https://api.trycourier.app/";

    /**
     * Courier authorization token.
     *
     * @var string
     */
    private $auth_token;

    /**
     * Courier authorization email.
     *
     * @var string
     */
    private $email;

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
     * @param string $auth_token
     * @param string|null $email
     */
    public function __construct(string $auth_token, string $email = NULL)
    {
        $this->auth_token = $auth_token;
        $this->email = $email;

        $this->setAuthorization($auth_token, $email);
    }

    /**
     * Sets authentication header string, either Bearer or Basic
     *
     * @param string $auth_token
     * @param string|null $email
     * @return void
     */
    public function setAuthorization(string $auth_token, string $email = NULL): void
    {
        if($email){
            $this->authorization = [
                'type' => 'Basic',
                'token' => base64_encode($email . ':' . $auth_token),
            ];
        } else {
            $this->authorization = [
                'type' => 'Bearer',
                'token' => $auth_token,
            ];
        }
    }

    /**
     * Get the current authorization header.
     *
     * @return string
     */
    public function getAuthorizationHeader(): string
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
        if( empty($this->httpClient) ){
            $this->httpClient = new Shuttle;
        }

        return $this->httpClient;
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
     * @return RequestInterface|Request
     */
    private function buildRequest(string $method, string $path, array $params = []): RequestInterface
    {
        return new Request(
            $method,
            $this->host_name . $path,
            \json_encode($params),
            [
                "Authorization" => $this->getAuthorizationHeader(),
                "Content-Type" => "application/json",
                'User-Agent' => 'courier-php/'.$this->version
            ]
        );
    }

    /**
     * Send a notification to a specified recipient.
     *
     * @param string $event
     * @param string $recipient
     * @param array $profile
     * @param array $data
     * @param array $preferences
     * @param array $overrides
     * @return object
     * @throws CourierRequestException
     * @throws \Psr\Http\Client\ClientExceptionInterface
     */
    public function sendNotification(string $event, string $recipient, array $profile = [], array $data = [], array $preferences = [], array $overrides = []): object
    {

        $params = array(
            'event' => $event,
            'recipient' => $recipient,
            'profile' => $profile,
            'data' => $data,
            'preferences' => $preferences,
            'overrides' => $overrides
        );

        return $this->doRequest(
            $this->buildRequest("post", "send", $params)
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
            $this->buildRequest("post", "messages/" . $message_id)
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
     * @param array $profile_attributes
     * @return object
     * @throws CourierRequestException
     */
    public function upsertProfile(string $recipient_id, array $profile_attributes): object
    {

        return $this->doRequest(
            $this->buildRequest("post", "profiles/" . $recipient_id, array('profile' => $profile_attributes))
        );
    }

    /**
     *  Replace an existing profile with the supplied values or
     *  create a new profile if one does not already exist.
     *
     * @param string $recipient_id
     * @param array $profile_attributes
     * @return object
     * @throws CourierRequestException
     */
    public function replaceProfile(string $recipient_id, array $profile_attributes): object
    {

        return $this->doRequest(
            $this->buildRequest("put", "profiles/" . $recipient_id, array('profile' => $profile_attributes))
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
            $this->buildRequest("patch", "preferences/" . $recipient_id, array('patch' => $patch))
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

}
