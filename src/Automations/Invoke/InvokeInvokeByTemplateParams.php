<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Invoke an automation run from an automation template.
 *
 * @see Courier\Services\Automations\InvokeService::invokeByTemplate()
 *
 * @phpstan-type InvokeInvokeByTemplateParamsShape = array{
 *   recipient: string|null,
 *   brand?: string|null,
 *   data?: array<string,mixed>|null,
 *   profile?: array<string,mixed>|null,
 *   template?: string|null,
 * }
 */
final class InvokeInvokeByTemplateParams implements BaseModel
{
    /** @use SdkModel<InvokeInvokeByTemplateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public ?string $recipient;

    #[Optional(nullable: true)]
    public ?string $brand;

    /** @var array<string,mixed>|null $data */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $data;

    /** @var array<string,mixed>|null $profile */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $profile;

    #[Optional(nullable: true)]
    public ?string $template;

    /**
     * `new InvokeInvokeByTemplateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvokeInvokeByTemplateParams::with(recipient: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvokeInvokeByTemplateParams)->withRecipient(...)
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
     * @param array<string,mixed>|null $data
     * @param array<string,mixed>|null $profile
     */
    public static function with(
        ?string $recipient,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $template = null,
    ): self {
        $self = new self;

        $self['recipient'] = $recipient;

        null !== $brand && $self['brand'] = $brand;
        null !== $data && $self['data'] = $data;
        null !== $profile && $self['profile'] = $profile;
        null !== $template && $self['template'] = $template;

        return $self;
    }

    public function withRecipient(?string $recipient): self
    {
        $self = clone $this;
        $self['recipient'] = $recipient;

        return $self;
    }

    public function withBrand(?string $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    public function withTemplate(?string $template): self
    {
        $self = clone $this;
        $self['template'] = $template;

        return $self;
    }
}
