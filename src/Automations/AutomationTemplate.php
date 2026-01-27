<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Automations\AutomationTemplate\Version;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type AutomationTemplateShape = array{
 *   id: string,
 *   name: string,
 *   version: Version|value-of<Version>,
 *   createdAt?: \DateTimeInterface|null,
 *   updatedAt?: \DateTimeInterface|null,
 * }
 */
final class AutomationTemplate implements BaseModel
{
    /** @use SdkModel<AutomationTemplateShape> */
    use SdkModel;

    /**
     * The unique identifier of the automation template.
     */
    #[Required]
    public string $id;

    /**
     * The name of the automation template.
     */
    #[Required]
    public string $name;

    /**
     * The version of the template published or drafted.
     *
     * @var value-of<Version> $version
     */
    #[Required(enum: Version::class)]
    public string $version;

    /**
     * ISO 8601 timestamp when the template was created.
     */
    #[Optional]
    public ?\DateTimeInterface $createdAt;

    /**
     * ISO 8601 timestamp when the template was last updated.
     */
    #[Optional]
    public ?\DateTimeInterface $updatedAt;

    /**
     * `new AutomationTemplate()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AutomationTemplate::with(id: ..., name: ..., version: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AutomationTemplate)->withID(...)->withName(...)->withVersion(...)
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
     *
     * @param Version|value-of<Version> $version
     */
    public static function with(
        string $id,
        string $name,
        Version|string $version,
        ?\DateTimeInterface $createdAt = null,
        ?\DateTimeInterface $updatedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['name'] = $name;
        $self['version'] = $version;

        null !== $createdAt && $self['createdAt'] = $createdAt;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;

        return $self;
    }

    /**
     * The unique identifier of the automation template.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * The name of the automation template.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The version of the template published or drafted.
     *
     * @param Version|value-of<Version> $version
     */
    public function withVersion(Version|string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }

    /**
     * ISO 8601 timestamp when the template was created.
     */
    public function withCreatedAt(\DateTimeInterface $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * ISO 8601 timestamp when the template was last updated.
     */
    public function withUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }
}
