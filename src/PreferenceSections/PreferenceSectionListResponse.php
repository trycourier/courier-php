<?php

declare(strict_types=1);

namespace Courier\PreferenceSections;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * The workspace's preference sections, each with its topics.
 *
 * @phpstan-import-type PreferenceSectionGetResponseShape from \Courier\PreferenceSections\PreferenceSectionGetResponse
 *
 * @phpstan-type PreferenceSectionListResponseShape = array{
 *   results: list<PreferenceSectionGetResponse|PreferenceSectionGetResponseShape>
 * }
 */
final class PreferenceSectionListResponse implements BaseModel
{
    /** @use SdkModel<PreferenceSectionListResponseShape> */
    use SdkModel;

    /** @var list<PreferenceSectionGetResponse> $results */
    #[Required(list: PreferenceSectionGetResponse::class)]
    public array $results;

    /**
     * `new PreferenceSectionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceSectionListResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceSectionListResponse)->withResults(...)
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
     * @param list<PreferenceSectionGetResponse|PreferenceSectionGetResponseShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<PreferenceSectionGetResponse|PreferenceSectionGetResponseShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
