<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationFetchDataStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'fetch-data' $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var AutomationFetchDataWebhook $webhook
     */
    #[JsonProperty('webhook')]
    public AutomationFetchDataWebhook $webhook;

    /**
     * @var value-of<MergeAlgorithm> $mergeStrategy
     */
    #[JsonProperty('merge_strategy')]
    public string $mergeStrategy;

    /**
     * @var ?string $idempotencyExpiry
     */
    #[JsonProperty('idempotency_expiry')]
    public ?string $idempotencyExpiry;

    /**
     * @var ?string $idempotencyKey
     */
    #[JsonProperty('idempotency_key')]
    public ?string $idempotencyKey;

    /**
     * @param array{
     *   action: 'fetch-data',
     *   webhook: AutomationFetchDataWebhook,
     *   mergeStrategy: value-of<MergeAlgorithm>,
     *   if?: ?string,
     *   ref?: ?string,
     *   idempotencyExpiry?: ?string,
     *   idempotencyKey?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->webhook = $values['webhook'];
        $this->mergeStrategy = $values['mergeStrategy'];
        $this->idempotencyExpiry = $values['idempotencyExpiry'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
