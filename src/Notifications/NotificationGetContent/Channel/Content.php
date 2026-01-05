<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent\Channel;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type ContentShape = array{subject?: string|null, title?: string|null}
 */
final class Content implements BaseModel
{
    /** @use SdkModel<ContentShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?string $subject;

    #[Optional(nullable: true)]
    public ?string $title;

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
        ?string $subject = null,
        ?string $title = null
    ): self {
        $self = new self;

        null !== $subject && $self['subject'] = $subject;
        null !== $title && $self['title'] = $title;

        return $self;
    }

    public function withSubject(?string $subject): self
    {
        $self = clone $this;
        $self['subject'] = $subject;

        return $self;
    }

    public function withTitle(?string $title): self
    {
        $self = clone $this;
        $self['title'] = $title;

        return $self;
    }
}
