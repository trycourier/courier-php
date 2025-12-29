<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookAuthenticationShape = array{
 *   mode: WebhookAuthMode|value-of<WebhookAuthMode>,
 *   token?: string|null,
 *   password?: string|null,
 *   username?: string|null,
 * }
 */
final class WebhookAuthentication implements BaseModel
{
    /** @use SdkModel<WebhookAuthenticationShape> */
    use SdkModel;

    /**
     * The authentication mode to use. Defaults to 'none' if not specified.
     *
     * @var value-of<WebhookAuthMode> $mode
     */
    #[Required(enum: WebhookAuthMode::class)]
    public string $mode;

    /**
     * Token for bearer authentication.
     */
    #[Optional(nullable: true)]
    public ?string $token;

    /**
     * Password for basic authentication.
     */
    #[Optional(nullable: true)]
    public ?string $password;

    /**
     * Username for basic authentication.
     */
    #[Optional(nullable: true)]
    public ?string $username;

    /**
     * `new WebhookAuthentication()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookAuthentication::with(mode: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookAuthentication)->withMode(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param WebhookAuthMode|value-of<WebhookAuthMode> $mode
     */
    public static function with(
        WebhookAuthMode|string $mode,
        ?string $token = null,
        ?string $password = null,
        ?string $username = null,
    ): self {
        $self = new self;

        $self['mode'] = $mode;

        null !== $token && $self['token'] = $token;
        null !== $password && $self['password'] = $password;
        null !== $username && $self['username'] = $username;

        return $self;
    }

    /**
     * The authentication mode to use. Defaults to 'none' if not specified.
     *
     * @param WebhookAuthMode|value-of<WebhookAuthMode> $mode
     */
    public function withMode(WebhookAuthMode|string $mode): self
    {
        $self = clone $this;
        $self['mode'] = $mode;

        return $self;
    }

    /**
     * Token for bearer authentication.
     */
    public function withToken(?string $token): self
    {
        $self = clone $this;
        $self['token'] = $token;

        return $self;
    }

    /**
     * Password for basic authentication.
     */
    public function withPassword(?string $password): self
    {
        $self = clone $this;
        $self['password'] = $password;

        return $self;
    }

    /**
     * Username for basic authentication.
     */
    public function withUsername(?string $username): self
    {
        $self = clone $this;
        $self['username'] = $username;

        return $self;
    }
}
