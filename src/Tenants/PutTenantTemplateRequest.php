<?php

declare(strict_types=1);

namespace Courier\Tenants;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for creating or updating a tenant notification template.
 *
 * @phpstan-import-type TenantTemplateInputShape from \Courier\Tenants\TenantTemplateInput
 *
 * @phpstan-type PutTenantTemplateRequestShape = array{
 *   template: TenantTemplateInput|TenantTemplateInputShape, published?: bool|null
 * }
 */
final class PutTenantTemplateRequest implements BaseModel
{
    /** @use SdkModel<PutTenantTemplateRequestShape> */
    use SdkModel;

    /**
     * Template configuration for creating or updating a tenant notification template.
     */
    #[Required]
    public TenantTemplateInput $template;

    /**
     * Whether to publish the template immediately after saving. When true, the template becomes the active/published version. When false (default), the template is saved as a draft.
     */
    #[Optional]
    public ?bool $published;

    /**
     * `new PutTenantTemplateRequest()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PutTenantTemplateRequest::with(template: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PutTenantTemplateRequest)->withTemplate(...)
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
     * @param TenantTemplateInput|TenantTemplateInputShape $template
     */
    public static function with(
        TenantTemplateInput|array $template,
        ?bool $published = null
    ): self {
        $self = new self;

        $self['template'] = $template;

        null !== $published && $self['published'] = $published;

        return $self;
    }

    /**
     * Template configuration for creating or updating a tenant notification template.
     *
     * @param TenantTemplateInput|TenantTemplateInputShape $template
     */
    public function withTemplate(TenantTemplateInput|array $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }

    /**
     * Whether to publish the template immediately after saving. When true, the template becomes the active/published version. When false (default), the template is saved as a draft.
     */
    public function withPublished(bool $published): self
    {
        $self = clone $this;
        $self['published'] = $published;

        return $self;
    }
}
