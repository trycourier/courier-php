<?php

declare(strict_types=1);

namespace Courier\WorkspacePreferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * The workspace's preferences, each with its topics.
 *
 * @phpstan-import-type WorkspacePreferenceGetResponseShape from \Courier\WorkspacePreferences\WorkspacePreferenceGetResponse
 *
 * @phpstan-type WorkspacePreferenceListResponseShape = array{
 *   results: list<WorkspacePreferenceGetResponse|WorkspacePreferenceGetResponseShape>,
 * }
 */
final class WorkspacePreferenceListResponse implements BaseModel
{
    /** @use SdkModel<WorkspacePreferenceListResponseShape> */
    use SdkModel;

    /** @var list<WorkspacePreferenceGetResponse> $results */
    #[Required(list: WorkspacePreferenceGetResponse::class)]
    public array $results;

    /**
     * `new WorkspacePreferenceListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WorkspacePreferenceListResponse::with(results: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WorkspacePreferenceListResponse)->withResults(...)
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
     * @param list<WorkspacePreferenceGetResponse|WorkspacePreferenceGetResponseShape> $results
     */
    public static function with(array $results): self
    {
        $self = new self;

        $self['results'] = $results;

        return $self;
    }

    /**
     * @param list<WorkspacePreferenceGetResponse|WorkspacePreferenceGetResponseShape> $results
     */
    public function withResults(array $results): self
    {
        $self = clone $this;
        $self['results'] = $results;

        return $self;
    }
}
