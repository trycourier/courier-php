<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * List Templates in Tenant.
 *
 * @see Courier\Services\Tenants\TemplatesService::list()
 *
 * @phpstan-type TemplateListParamsShape = array{
 *   cursor?: string|null, limit?: int|null
 * }
 */
final class TemplateListParams implements BaseModel
{
    /** @use SdkModel<TemplateListParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Continue the pagination with the next cursor.
     */
    #[Optional(nullable: true)]
    public ?string $cursor;

    /**
     * The number of templates to return (defaults to 20, maximum value of 100).
     */
    #[Optional(nullable: true)]
    public ?int $limit;

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
        ?string $cursor = null,
        ?int $limit = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $limit && $self['limit'] = $limit;

        return $self;
    }

    /**
     * Continue the pagination with the next cursor.
     */
    public function withCursor(?string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * The number of templates to return (defaults to 20, maximum value of 100).
     */
    public function withLimit(?int $limit): self
    {
        $self = clone $this;
        $self['limit'] = $limit;

        return $self;
    }
}
