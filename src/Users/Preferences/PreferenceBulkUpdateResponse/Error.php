<?php

declare(strict_types=1);

namespace Courier\Users\Preferences\PreferenceBulkUpdateResponse;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * A single topic that could not be applied in a bulk preference request.
 *
 * @phpstan-type ErrorShape = array{reason: string, topicID: string}
 */
final class Error implements BaseModel
{
    /** @use SdkModel<ErrorShape> */
    use SdkModel;

    /**
     * A human-readable explanation of why the topic could not be applied.
     */
    #[Required]
    public string $reason;

    #[Required('topic_id')]
    public string $topicID;

    /**
     * `new Error()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Error::with(reason: ..., topicID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Error)->withReason(...)->withTopicID(...)
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
    public static function with(string $reason, string $topicID): self
    {
        $self = new self;

        $self['reason'] = $reason;
        $self['topicID'] = $topicID;

        return $self;
    }

    /**
     * A human-readable explanation of why the topic could not be applied.
     */
    public function withReason(string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    public function withTopicID(string $topicID): self
    {
        $self = clone $this;
        $self['topicID'] = $topicID;

        return $self;
    }
}
