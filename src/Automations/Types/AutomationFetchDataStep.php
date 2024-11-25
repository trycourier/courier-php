<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;

class AutomationFetchDataStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
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
     *   action: string,
     *   webhook: AutomationFetchDataWebhook,
     *   mergeStrategy: value-of<MergeAlgorithm>,
     *   idempotencyExpiry?: ?string,
     *   idempotencyKey?: ?string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->webhook = $values['webhook'];
        $this->mergeStrategy = $values['mergeStrategy'];
        $this->idempotencyExpiry = $values['idempotencyExpiry'] ?? null;
        $this->idempotencyKey = $values['idempotencyKey'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
