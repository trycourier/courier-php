<?php

declare(strict_types=1);

namespace Courier\Journeys\JourneySendNode\Message;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ToShape = array{
 *   emailOverride?: string|null,
 *   phoneNumberOverride?: string|null,
 *   userIDOverride?: string|null,
 * }
 */
final class To implements BaseModel
{
    /** @use SdkModel<ToShape> */
    use SdkModel;

    #[Optional('email_override')]
    public ?string $emailOverride;

    #[Optional('phone_number_override')]
    public ?string $phoneNumberOverride;

    #[Optional('user_id_override')]
    public ?string $userIDOverride;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $emailOverride = null,
        ?string $phoneNumberOverride = null,
        ?string $userIDOverride = null,
    ): self {
        $self = new self;

        null !== $emailOverride && $self['emailOverride'] = $emailOverride;
        null !== $phoneNumberOverride && $self['phoneNumberOverride'] = $phoneNumberOverride;
        null !== $userIDOverride && $self['userIDOverride'] = $userIDOverride;

        return $self;
    }

    public function withEmailOverride(string $emailOverride): self
    {
        $self = clone $this;
        $self['emailOverride'] = $emailOverride;

        return $self;
    }

    public function withPhoneNumberOverride(string $phoneNumberOverride): self
    {
        $self = clone $this;
        $self['phoneNumberOverride'] = $phoneNumberOverride;

        return $self;
    }

    public function withUserIDOverride(string $userIDOverride): self
    {
        $self = clone $this;
        $self['userIDOverride'] = $userIDOverride;

        return $self;
    }
}
