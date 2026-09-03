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
 * Creates or updates a notification template scoped to one tenant, letting a tenant override the content the workspace template would send.
 *
 * This is an upsert: it creates when the tenant has no template under `template_id`, and updates when it does. On the create half, content must place its elements inside a channel block — `{ "type": "channel", "channel": "email", "elements": [...] }` — or the request returns `400`. The template designer renders only the channel block matching the tab it draws, so content stored without one cannot be opened. An empty `elements` array is accepted, as is the `{ title, body }` shorthand, which has no elements to wrap. Updates are not checked, so tenant templates already stored without a wrapper stay editable.
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
