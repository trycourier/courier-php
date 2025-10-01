<?php

declare(strict_types=1);

namespace Courier\Automations\Invoke;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-type automation_invoke_params = array{
 *   brand?: string|null,
 *   data?: array<string, mixed>|null,
 *   profile?: mixed,
 *   recipient?: string|null,
 *   template?: string|null,
 * }
 */
final class AutomationInvokeParams implements BaseModel
{
    /** @use SdkModel<automation_invoke_params> */
    use SdkModel;

    #[Api(nullable: true, optional: true)]
    public ?string $brand;

    /** @var array<string, mixed>|null $data */
    #[Api(map: 'mixed', nullable: true, optional: true)]
    public ?array $data;

    #[Api(optional: true)]
    public mixed $profile;

    #[Api(nullable: true, optional: true)]
    public ?string $recipient;

    #[Api(nullable: true, optional: true)]
    public ?string $template;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string, mixed>|null $data
     */
    public static function with(
        ?string $brand = null,
        ?array $data = null,
        mixed $profile = null,
        ?string $recipient = null,
        ?string $template = null,
    ): self {
        $obj = new self;

        null !== $brand && $obj->brand = $brand;
        null !== $data && $obj->data = $data;
        null !== $profile && $obj->profile = $profile;
        null !== $recipient && $obj->recipient = $recipient;
        null !== $template && $obj->template = $template;

        return $obj;
    }

    public function withBrand(?string $brand): self
    {
        $obj = clone $this;
        $obj->brand = $brand;

        return $obj;
    }

    /**
     * @param array<string, mixed>|null $data
     */
    public function withData(?array $data): self
    {
        $obj = clone $this;
        $obj->data = $data;

        return $obj;
    }

    public function withProfile(mixed $profile): self
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
