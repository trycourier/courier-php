<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type WebhookAuthenticationShape from \Courier\WebhookAuthentication
 *
 * @phpstan-type WebhookProfileShape = array{
 *   url: string,
 *   authentication?: null|WebhookAuthentication|WebhookAuthenticationShape,
 *   headers?: array<string,string>|null,
 *   method?: null|WebhookMethod|value-of<WebhookMethod>,
 *   profile?: null|WebhookProfileType|value-of<WebhookProfileType>,
 * }
 */
final class WebhookProfile implements BaseModel
{
    /** @use SdkModel<WebhookProfileShape> */
    use SdkModel;

    /**
     * The URL to send the webhook request to.
     */
    #[Required]
    public string $url;

    /**
     * Authentication configuration for the webhook request.
     */
    #[Optional(nullable: true)]
    public ?WebhookAuthentication $authentication;

    /**
     * Custom headers to include in the webhook request.
     *
     * @var array<string,string>|null $headers
     */
    #[Optional(map: 'string', nullable: true)]
    public ?array $headers;

    /**
     * The HTTP method to use for the webhook request. Defaults to POST if not specified.
     *
     * @var value-of<WebhookMethod>|null $method
     */
    #[Optional(enum: WebhookMethod::class, nullable: true)]
    public ?string $method;

    /**
     * Specifies what profile information is included in the request payload. Defaults to 'limited' if not specified.
     *
     * @var value-of<WebhookProfileType>|null $profile
     */
    #[Optional(enum: WebhookProfileType::class, nullable: true)]
    public ?string $profile;

    /**
     * `new WebhookProfile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookProfile::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookProfile)->withURL(...)
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
     * @param WebhookAuthentication|WebhookAuthenticationShape|null $authentication
     * @param array<string,string>|null $headers
     * @param WebhookMethod|value-of<WebhookMethod>|null $method
     * @param WebhookProfileType|value-of<WebhookProfileType>|null $profile
     */
    public static function with(
        string $url,
        WebhookAuthentication|array|null $authentication = null,
        ?array $headers = null,
        WebhookMethod|string|null $method = null,
        WebhookProfileType|string|null $profile = null,
    ): self {
        $self = new self;

        $self['url'] = $url;

        null !== $authentication && $self['authentication'] = $authentication;
        null !== $headers && $self['headers'] = $headers;
        null !== $method && $self['method'] = $method;
        null !== $profile && $self['profile'] = $profile;

        return $self;
    }

    /**
     * The URL to send the webhook request to.
     */
    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    /**
     * Authentication configuration for the webhook request.
     *
     * @param WebhookAuthentication|WebhookAuthenticationShape|null $authentication
     */
    public function withAuthentication(
        WebhookAuthentication|array|null $authentication
    ): self {
        $self = clone $this;
        $self['authentication'] = $authentication;

        return $self;
    }

    /**
     * Custom headers to include in the webhook request.
     *
     * @param array<string,string>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }

    /**
     * The HTTP method to use for the webhook request. Defaults to POST if not specified.
     *
     * @param WebhookMethod|value-of<WebhookMethod>|null $method
     */
    public function withMethod(WebhookMethod|string|null $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    /**
     * Specifies what profile information is included in the request payload. Defaults to 'limited' if not specified.
     *
     * @param WebhookProfileType|value-of<WebhookProfileType>|null $profile
     */
    public function withProfile(WebhookProfileType|string|null $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }
}
