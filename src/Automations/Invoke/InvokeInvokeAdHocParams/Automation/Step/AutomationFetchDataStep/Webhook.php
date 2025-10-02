<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationFetchDataStep\Webhook\Method;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type webhook_alias = array{
 *   method: value-of<Method>,
 *   url: string,
 *   body?: array<string, mixed>|null,
 *   headers?: array<string, mixed>|null,
 *   params?: array<string, mixed>|null,
 * }
 */
final class Webhook implements BaseModel
{
    /** @use SdkModel<webhook_alias> */
    use SdkModel;

    /** @var value-of<Method> $method */
    #[Api(enum: Method::class)]
    public string $method;

    #[Api]
    public string $url;

    /** @var array<string, mixed>|null $body */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $body;

    /** @var array<string, mixed>|null $headers */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $headers;

    /** @var array<string, mixed>|null $params */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $params;

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
     * @param array<string, mixed>|null $body
     * @param array<string, mixed>|null $headers
     * @param array<string, mixed>|null $params
     */
    public static function with(
        Method|string $method,
        string $url,
        ?array $body = null,
        ?array $headers = null,
        ?array $params = null,
    ): self {
        $obj = new self;

        $obj->method = $method instanceof Method ? $method->value : $method;
        $obj->url = $url;

        null !== $body && $obj->body = $body;
        null !== $headers && $obj->headers = $headers;
        null !== $params && $obj->params = $params;

        return $obj;
    }

    /**
     * @param Method|value-of<Method> $method
     */
    public function withMethod(Method|string $method): self
    {
        $obj = clone $this;
        $obj->method = $method instanceof Method ? $method->value : $method;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $body
     */
    public function withBody(?array $body): self
    {
        $obj = clone $this;
        $obj->body = $body;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $headers
     */
    public function withHeaders(?array $headers): self
    {
        $obj = clone $this;
        $obj->headers = $headers;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $params
     */
    public function withParams(?array $params): self
    {
        $obj = clone $this;
        $obj->params = $params;

        return $obj;
    }
}
