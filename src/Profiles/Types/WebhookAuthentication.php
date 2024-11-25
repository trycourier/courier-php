<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class WebhookAuthentication extends JsonSerializableType
{
    /**
     * @var value-of<WebhookAuthMode> $mode The authentication mode to use. Defaults to 'none' if not specified.
     */
    #[JsonProperty('mode')]
    public string $mode;

    /**
     * @var ?string $username Username for basic authentication.
     */
    #[JsonProperty('username')]
    public ?string $username;

    /**
     * @var ?string $password Password for basic authentication.
     */
    #[JsonProperty('password')]
    public ?string $password;

    /**
     * @var ?string $token Token for bearer authentication.
     */
    #[JsonProperty('token')]
    public ?string $token;

    /**
     * @param array{
     *   mode: value-of<WebhookAuthMode>,
     *   username?: ?string,
     *   password?: ?string,
     *   token?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->mode = $values['mode'];
        $this->username = $values['username'] ?? null;
        $this->password = $values['password'] ?? null;
        $this->token = $values['token'] ?? null;
    }
}
