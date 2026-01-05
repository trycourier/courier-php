<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch the array of events of a message you've previously sent.
 *
 * @see Courier\Services\MessagesService::history()
 *
 * @phpstan-type MessageHistoryParamsShape = array{type?: string|null}
 */
final class MessageHistoryParams implements BaseModel
{
    /** @use SdkModel<MessageHistoryParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * A supported Message History type that will filter the events returned.
     */
    #[Optional(nullable: true)]
    public ?string $type;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(?string $type = null): self
    {
        $self = new self;

        null !== $type && $self['type'] = $type;

        return $self;
    }

    /**
     * A supported Message History type that will filter the events returned.
     */
    public function withType(?string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }
}
