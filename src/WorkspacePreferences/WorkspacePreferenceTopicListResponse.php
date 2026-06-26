<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Topics contained in a workspace preference.
 *
 * @phpstan-import-type WorkspacePreferenceTopicGetResponseShape from \Courier\WorkspacePreferences\WorkspacePreferenceTopicGetResponse
 *
 * @phpstan-type WorkspacePreferenceTopicListResponseShape = array{
 *   results: list<WorkspacePreferenceTopicGetResponse|WorkspacePreferenceTopicGetResponseShape>,
 * }
 */
final class WorkspacePreferenceTopicListResponse implements BaseModel
{
    /** @use SdkModel<WorkspacePreferenceTopicListResponseShape> */
    use SdkModel;

    /** @var list<WorkspacePreferenceTopicGetResponse> $results */
    #[Required(list: WorkspacePreferenceTopicGetResponse::class)]
    public array $results;

    /**
     * `new WorkspacePreferenceTopicListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkspacePreferenceTopicListResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkspacePreferenceTopicListResponse)->withResults(...)
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
     * @param list<WorkspacePreferenceTopicGetResponse|WorkspacePreferenceTopicGetResponseShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<WorkspacePreferenceTopicGetResponse|WorkspacePreferenceTopicGetResponseShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
