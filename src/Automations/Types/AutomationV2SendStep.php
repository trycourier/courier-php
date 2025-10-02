<?php

namespace Courier\Automations\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Automations\Traits\AutomationStep;
use Courier\Core\Json\JsonProperty;
use Courier\Send\Types\ContentMessage;
use Courier\Send\Types\TemplateMessage;
use Courier\Core\Types\Union;

class AutomationV2SendStep extends JsonSerializableType
{
    use AutomationStep;

    /**
     * @var 'send' $action
     */
    #[JsonProperty('action')]
    public string $action;

    /**
     * @var (
     *    ContentMessage
     *   |TemplateMessage
     * ) $message
     */
    #[JsonProperty('message'), Union(ContentMessage::class, TemplateMessage::class)]
    public ContentMessage|TemplateMessage $message;

    /**
     * @param array{
     *   action: 'send',
     *   message: (
     *    ContentMessage
     *   |TemplateMessage
     * ),
     *   if?: ?string,
     *   ref?: ?string,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->if = $values['if'] ?? null;
        $this->ref = $values['ref'] ?? null;
        $this->action = $values['action'];
        $this->message = $values['message'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
