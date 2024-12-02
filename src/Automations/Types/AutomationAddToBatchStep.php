<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class AutomationAddToBatchStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var string $waitPeriod Defines the period of inactivity before the batch is released. Specified as an [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     */
    #[JsonProperty('wait_period')]
    public string $waitPeriod;

    /**
     * @var string $maxWaitPeriod Defines the maximum wait time before the batch should be released. Must be less than wait period. Maximum of 60 days. Specified as an [ISO 8601 duration](https://en.wikipedia.org/wiki/ISO_8601#Durations)
     */
    #[JsonProperty('max_wait_period')]
    public string $maxWaitPeriod;

    /**
     * @var string|int|null $maxItems If specified, the batch will release as soon as this number is reached
     */
    #[JsonProperty('max_items'), Union('string', 'integer', 'null')]
    public string|int|null $maxItems;

    /**
     * @var AutomationAddToBatchRetain $retain
     */
    #[JsonProperty('retain')]
    public AutomationAddToBatchRetain $retain;

    /**
     * @var ?value-of<AutomationAddToBatchScope> $scope Determine the scope of the batching. If user, chosen in this order: recipient, profile.user_id, data.user_id, data.userId.
    If dynamic, then specify where the batch_key or a reference to the batch_key
     */
    #[JsonProperty('scope')]
    public ?string $scope;

    /**
     * @var ?string $batchKey If using scope=dynamic, provide the key or a reference (e.g., refs.data.batch_key)
     */
    #[JsonProperty('batch_key')]
    public ?string $batchKey;

    /**
     * @var ?string $batchId
     */
    #[JsonProperty('batch_id')]
    public ?string $batchId;

    /**
     * @var ?string $categoryKey Defines the field of the data object the batch is set to when complete. Defaults to `batch`
     */
    #[JsonProperty('category_key')]
    public ?string $categoryKey;

    /**
     * @param array{
     *   action: string,
     *   waitPeriod: string,
     *   maxWaitPeriod: string,
     *   maxItems?: string|int|null,
     *   retain: AutomationAddToBatchRetain,
     *   scope?: ?value-of<AutomationAddToBatchScope>,
     *   batchKey?: ?string,
     *   batchId?: ?string,
     *   categoryKey?: ?string,
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->waitPeriod = $values['waitPeriod'];
        $this->maxWaitPeriod = $values['maxWaitPeriod'];
        $this->maxItems = $values['maxItems'] ?? null;
        $this->retain = $values['retain'];
        $this->scope = $values['scope'] ?? null;
        $this->batchKey = $values['batchKey'] ?? null;
        $this->batchId = $values['batchId'] ?? null;
        $this->categoryKey = $values['categoryKey'] ?? null;
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
    }
}
