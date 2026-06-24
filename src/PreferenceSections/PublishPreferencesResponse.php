<?php

declare(strict_types=1);

namespace Courier\PreferenceSections;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Result of publishing the workspace's preferences page.
 *
 * @phpstan-type PublishPreferencesResponseShape = array{
 *   pageID: string,
 *   publishedAt: string,
 *   publishedVersion: float,
 *   previewURL?: string|null,
 *   publishedBy?: string|null,
 * }
 */
final class PublishPreferencesResponse implements BaseModel
{
    /** @use SdkModel<PublishPreferencesResponseShape> */
    use SdkModel;

    /**
     * Id of the published page snapshot.
     */
    #[Required('page_id')]
    public string $pageID;

    /**
     * ISO-8601 timestamp of the publish.
     */
    #[Required('published_at')]
    public string $publishedAt;

    /**
     * Monotonic published version (epoch milliseconds).
     */
    #[Required('published_version')]
    public float $publishedVersion;

    /**
     * Draft-mode hosted preferences page URL for previewing.
     */
    #[Optional('preview_url', nullable: true)]
    public ?string $previewURL;

    /**
     * Id of the publisher.
     */
    #[Optional('published_by', nullable: true)]
    public ?string $publishedBy;

    /**
     * `new PublishPreferencesResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PublishPreferencesResponse::with(
     *   pageID: ..., publishedAt: ..., publishedVersion: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PublishPreferencesResponse)
     *   ->withPageID(...)
     *   ->withPublishedAt(...)
     *   ->withPublishedVersion(...)
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
    public static function with(
        string $pageID,
        string $publishedAt,
        float $publishedVersion,
        ?string $previewURL = null,
        ?string $publishedBy = null,
    ): self {
        $self = new self;

        $self['pageID'] = $pageID;
        $self['publishedAt'] = $publishedAt;
        $self['publishedVersion'] = $publishedVersion;

        null !== $previewURL && $self['previewURL'] = $previewURL;
        null !== $publishedBy && $self['publishedBy'] = $publishedBy;

        return $self;
    }

    /**
     * Id of the published page snapshot.
     */
    public function withPageID(string $pageID): self
    {
        $self = clone $this;
        $self['pageID'] = $pageID;

        return $self;
    }

    /**
     * ISO-8601 timestamp of the publish.
     */
    public function withPublishedAt(string $publishedAt): self
    {
        $self = clone $this;
        $self['publishedAt'] = $publishedAt;

        return $self;
    }

    /**
     * Monotonic published version (epoch milliseconds).
     */
    public function withPublishedVersion(float $publishedVersion): self
    {
        $self = clone $this;
        $self['publishedVersion'] = $publishedVersion;

        return $self;
    }

    /**
     * Draft-mode hosted preferences page URL for previewing.
     */
    public function withPreviewURL(?string $previewURL): self
    {
        $self = clone $this;
        $self['previewURL'] = $previewURL;

        return $self;
    }

    /**
     * Id of the publisher.
     */
    public function withPublishedBy(?string $publishedBy): self
    {
        $self = clone $this;
        $self['publishedBy'] = $publishedBy;

        return $self;
    }
}
