<?php

declare(strict_types=1);

namespace Courier\Send\BaseMessageSendTo\To\WebhookRecipient;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient\Webhook\Authentication;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient\Webhook\Method;
use Courier\Send\BaseMessageSendTo\To\WebhookRecipient\Webhook\Profile;

/**
 * @phpstan-type webhook_alias = array{
 *   url: string,
 *   authentication?: Authentication|null,
 *   headers?: array<string, string>|null,
 *   method?: value-of<Method>|null,
 *   profile?: value-of<Profile>|null,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<webhook_alias> */
    use SdkModel;

    /**
     * The URL to send the webhook request to.
     */
    #[Api]
    public string $url;

    /**
     * Authentication configuration for the webhook request.
     */
    #[Api(nullable: true, optional: true)]
    public ?Authentication $authentication;

    /**
     * Custom headers to include in the webhook request.
     *
     * @var array<string, string>|null $headers
     */
    #[Api(map: 'string', nullable: true, optional: true)]
    public ?array $headers;

    /**
     * The HTTP method to use for the webhook request. Defaults to POST if not specified.
     *
     * @var value-of<Method>|null $method
     */
    #[Api(enum: Method::class, nullable: true, optional: true)]
    public ?string $method;

    /**
     * Specifies what profile information is included in the request payload. Defaults to 'limited' if not specified.
     *
     * @var value-of<Profile>|null $profile
     */
    #[Api(enum: Profile::class, nullable: true, optional: true)]
    public ?string $profile;

    /**
     * `new Webhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Webhook::with(url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Webhook)->withURL(...)
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
     * @param array<string, string>|null $headers
     * @param Method|value-of<Method>|null $method
     * @param Profile|value-of<Profile>|null $profile
     */
    public static function with(
        string $url,
        ?Authentication $authentication = null,
        ?array $headers = null,
        Method|string|null $method = null,
        Profile|string|null $profile = null,
    ): self {
        $obj = new self;

        $obj->url = $url;

        null !== $authentication && $obj->authentication = $authentication;
        null !== $headers && $obj->headers = $headers;
        null !== $method && $obj->method = $method instanceof Method ? $method->value : $method;
        null !== $profile && $obj->profile = $profile instanceof Profile ? $profile->value : $profile;

        return $obj;
    }

    /**
     * The URL to send the webhook request to.
     */
    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * Authentication configuration for the webhook request.
     */
    public function withAuthentication(?Authentication $authentication): self
    {
        $obj = clone $this;
        $obj->authentication = $authentication;

        return $obj;
    }

    /**
     * Custom headers to include in the webhook request.
     *
     * @param array<string, string>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $obj = clone $this;
        $obj->headers = $headers;

        return $obj;
    }

    /**
     * The HTTP method to use for the webhook request. Defaults to POST if not specified.
     *
     * @param Method|value-of<Method>|null $method
     */
    public function withMethod(Method|string|null $method): self
    {
        $obj = clone $this;
        $obj->method = $method instanceof Method ? $method->value : $method;

        return $obj;
    }

    /**
     * Specifies what profile information is included in the request payload. Defaults to 'limited' if not specified.
     *
     * @param Profile|value-of<Profile>|null $profile
     */
    public function withProfile(Profile|string|null $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile instanceof Profile ? $profile->value : $profile;

        return $obj;
    }
}
