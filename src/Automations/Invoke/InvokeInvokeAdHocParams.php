<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Invoke an ad hoc automation run. This endpoint accepts a JSON payload with a series of automation steps. For information about what steps are available, checkout the ad hoc automation guide [here](https://www.courier.com/docs/automations/steps/).
 *
 * @see Courier\Automations\Invoke->invokeAdHoc
 *
 * @phpstan-type InvokeInvokeAdHocParamsShape = array{
 *   automation: Automation,
 *   brand?: string|null,
 *   data?: array<string,mixed>|null,
 *   profile?: array<string,mixed>|null,
 *   recipient?: string|null,
 *   template?: string|null,
 * }
 */
final class InvokeInvokeAdHocParams implements BaseModel
{
    /** @use SdkModel<InvokeInvokeAdHocParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public Automation $automation;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /** @var array<string,mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    /** @var array<string,mixed>|null $profile */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $profile;

    #[Api(nullable: true, optional: true)]
    public ?string $recipient;

    #[Api(nullable: true, optional: true)]
    public ?string $template;

    /**
     * `new InvokeInvokeAdHocParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * InvokeInvokeAdHocParams::with(automation: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new InvokeInvokeAdHocParams)->withAutomation(...)
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
        Automation $automation,
        ?string $brand = null,
        ?array $data = null,
        ?array $profile = null,
        ?string $recipient = null,
        ?string $template = null,
    ): self {
        $obj = new self;

        $obj->automation = $automation;

        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $profile && $obj->profile = $profile;
        null !== $recipient && $obj->recipient = $recipient;
        null !== $template && $obj->template = $template;

        return $obj;
    }

    public function withAutomation(Automation $automation): self
    {
        $obj = clone $this;
        $obj->automation = $automation;

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

    public function withRecipient(?string $recipient): self
    {
        $obj = clone $this;
        $obj->recipient = $recipient;

        return $obj;
    }

    public function withTemplate(?string $template): self
    {
        $obj = clone $this;
        $obj->template = $template;

        return $obj;
    }
}
