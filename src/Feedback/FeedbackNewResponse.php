<?php

declare(strict_types=1);

namespace Courier\Feedback;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type FeedbackNewResponseShape = array{feedbackID: string}
 */
final class FeedbackNewResponse implements BaseModel
{
    /** @use SdkModel<FeedbackNewResponseShape> */
    use SdkModel;

    /**
     * The ID of the stored report, `fbk_` followed by a ULID.
     */
    #[Required('feedback_id')]
    public string $feedbackID;

    /**
     * `new FeedbackNewResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * FeedbackNewResponse::with(feedbackID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new FeedbackNewResponse)->withFeedbackID(...)
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
    public static function with(string $feedbackID): self
    {
        $self = new self;

        $self['feedbackID'] = $feedbackID;

        return $self;
    }

    /**
     * The ID of the stored report, `fbk_` followed by a ULID.
     */
    public function withFeedbackID(string $feedbackID): self
    {
        $self = clone $this;
        $self['feedbackID'] = $feedbackID;

        return $self;
    }
}
