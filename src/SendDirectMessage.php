<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type SendDirectMessageShape = array{userID: string}
 */
final class SendDirectMessage implements BaseModel
{
    /** @use SdkModel<SendDirectMessageShape> */
    use SdkModel;

    #[Required('user_id')]
    public string $userID;

    /**
     * `new SendDirectMessage()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SendDirectMessage::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SendDirectMessage)->withUserID(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $userID): self
    {
        $self = new self;

        $self['userID'] = $userID;

        return $self;
    }

    public function withUserID(string $userID): self
    {
        $self = clone $this;
        $self['userID'] = $userID;

        return $self;
    }
}
