<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences\Topics;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Turn off a topic's digest, leaving the topic itself in place. The template is unlinked and the digest's schedules are removed along with their delivery rules. Equivalent to sending `digest: null` on a topic replace.
 *
 * @see Courier\Services\WorkspacePreferences\TopicsService::deleteDigest()
 *
 * @phpstan-type TopicDeleteDigestParamsShape = array{sectionID: string}
 */
final class TopicDeleteDigestParams implements BaseModel
{
    /** @use SdkModel<TopicDeleteDigestParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $sectionID;

    /**
     * `new TopicDeleteDigestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicDeleteDigestParams::with(sectionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicDeleteDigestParams)->withSectionID(...)
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
