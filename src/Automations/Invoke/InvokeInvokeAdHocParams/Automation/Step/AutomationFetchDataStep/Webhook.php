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
        $obj = new self;

        $obj['method'] = $method;
        $obj['url'] = $url;

        null !== $body && $obj['body'] = $body;
        null !== $headers && $obj['headers'] = $headers;

        return $obj;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $obj = clone $this;
        $obj['method'] = $method;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj['url'] = $url;

        return $obj;
    }

    public function withBody(?string $body): self
    {
        $obj = clone $this;
        $obj['body'] = $body;

        return $obj;
    }

    /**
     * @param array<string,string>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $obj = clone $this;
        $obj['headers'] = $headers;

        return $obj;
    }
}
