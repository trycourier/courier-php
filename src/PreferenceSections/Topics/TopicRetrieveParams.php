<?php

declare(strict_types=1);

namespace Courier\PreferenceSections\Topics;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Retrieve a topic within a section. Returns 404 if the section does not exist, the topic does not exist, or the topic belongs to a different section.
 *
 * @see Courier\Services\PreferenceSections\TopicsService::retrieve()
 *
 * @phpstan-type TopicRetrieveParamsShape = array{sectionID: string}
 */
final class TopicRetrieveParams implements BaseModel
{
    /** @use SdkModel<TopicRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $sectionID;

    /**
     * `new TopicRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TopicRetrieveParams::with(sectionID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TopicRetrieveParams)->withSectionID(...)
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
