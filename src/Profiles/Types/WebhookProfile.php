<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class WebhookProfile extends JsonSerializableType
{
    /**
     * @var string $url The URL to send the webhook request to.
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @var ?value-of<WebhookMethod> $method The HTTP method to use for the webhook request. Defaults to POST if not specified.
     */
    #[JsonProperty('method')]
    public ?string $method;

    /**
     * @var ?array<string, string> $headers Custom headers to include in the webhook request.
     */
    #[JsonProperty('headers'), ArrayType(['string' => 'string'])]
    public ?array $headers;

    /**
     * @var ?WebhookAuthentication $authentication Authentication configuration for the webhook request.
     */
    #[JsonProperty('authentication')]
    public ?WebhookAuthentication $authentication;

    /**
     * @var ?value-of<WebhookProfileType> $profile Specifies what profile information is included in the request payload. Defaults to 'limited' if not specified.
     */
    #[JsonProperty('profile')]
    public ?string $profile;

    /**
     * @param array{
     *   url: string,
     *   method?: ?value-of<WebhookMethod>,
     *   headers?: ?array<string, string>,
     *   authentication?: ?WebhookAuthentication,
     *   profile?: ?value-of<WebhookProfileType>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->url = $values['url'];
        $this->method = $values['method'] ?? null;
        $this->headers = $values['headers'] ?? null;
        $this->authentication = $values['authentication'] ?? null;
        $this->profile = $values['profile'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
