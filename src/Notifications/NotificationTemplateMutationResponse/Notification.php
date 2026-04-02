<?php

declare(strict_types=1);

namespace Courier\Notifications\NotificationTemplateMutationResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type NotificationShape = array{id: string}
 */
final class Notification implements BaseModel
{
    /** @use SdkModel<NotificationShape> */
    use SdkModel;

    /**
     * The ID of the created or updated template.
     */
    #[Required]
    public string $id;

    /**
     * `new Notification()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Notification::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Notification)->withID(...)
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
    public static function with(string $id): self
    {
        $self = new self;

        $self['id'] = $id;

        return $self;
    }

    /**
     * The ID of the created or updated template.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }
}
