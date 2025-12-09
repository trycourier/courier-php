<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationGetContent\Channel;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type LocaleShape = array{subject?: string|null, title?: string|null}
 */
final class Locale implements BaseModel
{
    /** @use SdkModel<LocaleShape> */
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
        $obj = new self;

        null !== $subject && $obj['subject'] = $subject;
        null !== $title && $obj['title'] = $title;

        return $obj;
    }

    public function withSubject(?string $subject): self
    {
        $obj = clone $this;
        $obj['subject'] = $subject;

        return $obj;
    }

    public function withTitle(?string $title): self
    {
        $obj = clone $this;
        $obj['title'] = $title;

        return $obj;
    }
}
