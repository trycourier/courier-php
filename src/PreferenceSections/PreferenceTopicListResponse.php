<?php

declare(strict_types=1);

namespace Courier\PreferenceSections;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Topics contained in a preference section.
 *
 * @phpstan-import-type PreferenceTopicGetResponseShape from \Courier\PreferenceSections\PreferenceTopicGetResponse
 *
 * @phpstan-type PreferenceTopicListResponseShape = array{
 *   results: list<PreferenceTopicGetResponse|PreferenceTopicGetResponseShape>
 * }
 */
final class PreferenceTopicListResponse implements BaseModel
{
    /** @use SdkModel<PreferenceTopicListResponseShape> */
    use SdkModel;

    /** @var list<PreferenceTopicGetResponse> $results */
    #[Required(list: PreferenceTopicGetResponse::class)]
    public array $results;

    /**
     * `new PreferenceTopicListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceTopicListResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceTopicListResponse)->withResults(...)
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
     * @param list<PreferenceTopicGetResponse|PreferenceTopicGetResponseShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<PreferenceTopicGetResponse|PreferenceTopicGetResponseShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
