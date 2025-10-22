<?php

declare(strict_types=1);

namespace Courier\Messages;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Fetch the array of events of a message you've previously sent.
 *
 * @see Courier\Messages->history
 *
 * @phpstan-type message_history_params = array{type?: string|null}
 */
final class MessageHistoryParams implements BaseModel
{
    /** @use SdkModel<message_history_params> */
    use SdkModel;
    use SdkParams;

    /**
     * A supported Message History type that will filter the events returned.
     */
    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        null !== $type && $obj->type = $type;

        return $obj;
    }

    /**
     * A supported Message History type that will filter the events returned.
     */
    public function withType(?string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }
}
