<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Invoke an automation run from an automation template.
 *
 * @see Courier\Automations\Invoke->invokeByTemplate
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

    #[Api]
    public ?string $recipient;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /** @var array<string,mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /** @var array<string,mixed>|null $profile */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $profile;

    #[Api(nullable: true, optional: true)]
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
        $obj = new self;

        $obj->recipient = $recipient;

        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $profile && $obj->profile = $profile;
        null !== $template && $obj->template = $template;

        return $obj;
    }

    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj->recipient = $recipient;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    /**
     * @param array<string,mixed>|null $profile
     */
    public function withProfile(?array $profile): self
    {
        $obj = clone $this;
        $obj->profile = $profile;

        return $obj;
    }

    public function withTemplate(?string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }
}
