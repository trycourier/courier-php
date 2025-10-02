<?php

namespace Courier\Messages\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Messages\Traits\MessageDetails;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\ArrayType;

class MessageDetailsExtended extends JsonSerializableType
{
    use MessageDetails;

    /**
     * @var ?array<array<string, mixed>> $providers
     */
    #[JsonProperty('providers'), ArrayType([['string' => 'mixed']])]
    public ?array $providers;

    /**
     * @param array{
     *   id: string,
     *   status: value-of<MessageStatus>,
     *   enqueued: int,
     *   sent: int,
     *   delivered: int,
     *   opened: int,
     *   clicked: int,
     *   recipient: string,
     *   event: string,
     *   notification: string,
     *   error?: ?string,
     *   reason?: ?value-of<Reason>,
     *   providers?: ?array<array<string, mixed>>,
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->id = $values['id'];
        $this->status = $values['status'];
        $this->enqueued = $values['enqueued'];
        $this->sent = $values['sent'];
        $this->delivered = $values['delivered'];
        $this->opened = $values['opened'];
        $this->clicked = $values['clicked'];
        $this->recipient = $values['recipient'];
        $this->event = $values['event'];
        $this->notification = $values['notification'];
        $this->error = $values['error'] ?? null;
        $this->reason = $values['reason'] ?? null;
        $this->providers = $values['providers'] ?? null;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
