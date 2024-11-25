<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;

class AutomationUpdateProfileStep extends JsonSerializableType
{
    /**
     * @var string $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var string $recipientId
     */
    #[JsonProperty('recipient_id')]
    public string $recipientId;

    /**
     * @var mixed $profile
     */
    #[JsonProperty('profile')]
    public mixed $profile;

    /**
     * @var value-of<MergeAlgorithm> $merge
     */
    #[JsonProperty('merge')]
    public string $merge;

    /**
     * @param array{
     *   action: string,
     *   recipientId: string,
     *   profile: mixed,
     *   merge: value-of<MergeAlgorithm>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->action = $values['action'];
        $this->recipientId = $values['recipientId'];
        $this->profile = $values['profile'];
        $this->merge = $values['merge'];
    }
}
