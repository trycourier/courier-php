<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences\Topics;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Archives a subscription topic and removes it from its workspace preference, addressed by section id and topic id.
 *
 * @see Courier\Services\WorkspacePreferences\TopicsService::archive()
 *
 * @phpstan-type TopicArchiveParamsShape = array{sectionID: string}
 */
final class TopicArchiveParams implements BaseModel
{
    /** @use SdkModel<TopicArchiveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $sectionID;

    /**
     * `new TopicArchiveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicArchiveParams::with(sectionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicArchiveParams)->withSectionID(...)
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
    public static function with(string $sectionID): self
    {
        $self = new self;

        $self['sectionID'] = $sectionID;

        return $self;
    }

    public function withSectionID(string $sectionID): self
    {
        $self = clone $this;
        $self['sectionID'] = $sectionID;

        return $self;
    }
}
