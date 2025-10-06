<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationContent\Channel;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type content_alias = array{subject?: string|null, title?: string|null}
 */
final class Content implements BaseModel
{
    /** @use SdkModel<content_alias> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $subject;

    #[Api(nullable: true, optional: true)]
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

        null !== $subject && $obj->subject = $subject;
        null !== $title && $obj->title = $title;

        return $obj;
    }

    public function withSubject(?string $subject): self
    {
        $obj = clone $this;
        $obj->subject = $subject;

        return $obj;
    }

    public function withTitle(?string $title): self
    {
        $obj = clone $this;
        $obj->title = $title;

        return $obj;
    }
}
