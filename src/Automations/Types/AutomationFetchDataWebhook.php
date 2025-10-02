<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class AutomationFetchDataWebhook extends JsonSerializableType
{
    /**
     * @var ?array<string, mixed> $body
     */
    #[JsonProperty('body'), ArrayType(['string' => 'mixed'])]
    public ?array $body;

    /**
     * @var ?array<string, mixed> $headers
     */
    #[JsonProperty('headers'), ArrayType(['string' => 'mixed'])]
    public ?array $headers;

    /**
     * @var ?array<string, mixed> $params
     */
    #[JsonProperty('params'), ArrayType(['string' => 'mixed'])]
    public ?array $params;

    /**
     * @var value-of<AutomationFetchDataWebhookMethod> $method
     */
    #[JsonProperty('method')]
    public string $method;

    /**
     * @var string $url
     */
    #[JsonProperty('url')]
    public string $url;

    /**
     * @param array{
     *   method: value-of<AutomationFetchDataWebhookMethod>,
     *   url: string,
     *   body?: ?array<string, mixed>,
     *   headers?: ?array<string, mixed>,
     *   params?: ?array<string, mixed>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->body = $values['body'] ?? null;
        $this->headers = $values['headers'] ?? null;
        $this->params = $values['params'] ?? null;
        $this->method = $values['method'];
        $this->url = $values['url'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
