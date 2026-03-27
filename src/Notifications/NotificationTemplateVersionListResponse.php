<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Paging;

/**
 * @phpstan-import-type PagingShape from \Courier\Paging
 * @phpstan-import-type VersionNodeShape from \Courier\Notifications\VersionNode
 *
 * @phpstan-type NotificationTemplateVersionListResponseShape = array{
 *   paging: Paging|PagingShape, versions: list<VersionNode|VersionNodeShape>
 * }
 */
final class NotificationTemplateVersionListResponse implements BaseModel
{
    /** @use SdkModel<NotificationTemplateVersionListResponseShape> */
    use SdkModel;

    #[Required]
    public Paging $paging;

    /** @var list<VersionNode> $versions */
    #[Required(list: VersionNode::class)]
    public array $versions;

    /**
     * `new NotificationTemplateVersionListResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateVersionListResponse::with(paging: ..., versions: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateVersionListResponse)
     *   ->withPaging(...)
     *   ->withVersions(...)
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
     * @param Paging|PagingShape $paging
     * @param list<VersionNode|VersionNodeShape> $versions
     */
    public static function with(Paging|array $paging, array $versions): self
    {
        $self = new self;

        $self['paging'] = $paging;
        $self['versions'] = $versions;

        return $self;
    }

    /**
     * @param Paging|PagingShape $paging
     */
    public function withPaging(Paging|array $paging): self
    {
        $self = clone $this;
        $self['paging'] = $paging;

        return $self;
    }

    /**
     * @param list<VersionNode|VersionNodeShape> $versions
     */
    public function withVersions(array $versions): self
    {
        $self = clone $this;
        $self['versions'] = $versions;

        return $self;
    }
}
