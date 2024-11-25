<?php

namespace Courier\Requests;

use Courier\Core\Json\JsonSerializableType;
use Courier\Send\Types\ContentMessage;
use Courier\Send\Types\TemplateMessage;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class SendMessageRequest extends JsonSerializableType
{
    /**
     * @var ContentMessage|TemplateMessage $message Defines the message to be delivered
     */
    #[JsonProperty('message'), Union(ContentMessage::class, TemplateMessage::class)]
    public ContentMessage|TemplateMessage $message;

    /**
     * @param array{
     *   message: ContentMessage|TemplateMessage,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->message = $values['message'];
    }
}
