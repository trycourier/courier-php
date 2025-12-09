<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook\Method;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type WebhookShape = array{
 *   method: value-of<Method>,
 *   url: string,
 *   body?: string|null,
 *   headers?: array<string,string>|null,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<WebhookShape> */
    use SdkModel;

    /** @var value-of<Method> $method */
    #[Required(enum: Method::class)]
    public string $method;

    #[Required]
    public string $url;

    #[Optional(nullable: true)]
    public ?string $body;

    /** @var array<string,string>|null $headers */
    #[Optional(map: 'string', nullable: true)]
    public ?array $headers;

    /**
     * `new Webhook()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Webhook::with(method: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Webhook)->withMethod(...)->withURL(...)
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
     * @param Method|value-of<Method> $method
     * @param array<string,string>|null $headers
     */
    public static function with(
        Method|string $method,
        string $url,
        ?string $body = null,
        ?array $headers = null,
    ): self {
        $self = new self;

        $self['method'] = $method;
        $self['url'] = $url;

        null !== $body && $self['body'] = $body;
        null !== $headers && $self['headers'] = $headers;

        return $self;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $self = clone $this;
        $self['method'] = $method;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withBody(?string $body): self
    {
        $self = clone $this;
        $self['body'] = $body;

        return $self;
    }

    /**
     * @param array<string,string>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $self = clone $this;
        $self['headers'] = $headers;

        return $self;
    }
}
