<?php

declare(strict_types=1);

namespace Courier\Tenants\Templates;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\TenantTemplateInput;

/**
 * Creates or updates a notification template for a tenant.
 *
 * If the template already exists for the tenant, it will be updated (200).
 * Otherwise, a new template is created (201).
 *
 * Optionally publishes the template immediately if the `published` flag is set to true.
 *
 * @see Courier\Services\Tenants\TemplatesService::replace()
 *
 * @phpstan-import-type TenantTemplateInputShape from \Courier\Tenants\TenantTemplateInput
 *
 * @phpstan-type TemplateReplaceParamsShape = array{
 *   tenantID: string,
 *   template: TenantTemplateInput|TenantTemplateInputShape,
 *   published?: bool|null,
 * }
 */
final class TemplateReplaceParams implements BaseModel
{
    /** @use SdkModel<TemplateReplaceParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $tenantID;

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
     * `new TemplateReplaceParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TemplateReplaceParams::with(tenantID: ..., template: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TemplateReplaceParams)->withTenantID(...)->withTemplate(...)
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
        string $tenantID,
        TenantTemplateInput|array $template,
        ?bool $published = null,
    ): self {
        $self = new self;

        $self['tenantID'] = $tenantID;
        $self['template'] = $template;

        null !== $published && $self['published'] = $published;

        return $self;
    }

    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

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
