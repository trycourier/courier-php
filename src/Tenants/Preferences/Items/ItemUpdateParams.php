<?php

declare(strict_types=1);

namespace Courier\Tenants\Preferences\Items;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\Preferences\Items\ItemUpdateParams\Status;

/**
 * Create or Replace Default Preferences For Topic.
 *
 * @see Courier\Services\Tenants\Preferences\ItemsService::update()
 *
 * @phpstan-type ItemUpdateParamsShape = array{
 *   tenant_id: string,
 *   status: Status|value-of<Status>,
 *   custom_routing?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   has_custom_routing?: bool|null,
 * }
 */
final class ItemUpdateParams implements BaseModel
{
    /** @use SdkModel<ItemUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $tenant_id;

    /** @var value-of<Status> $status */
    #[Required(enum: Status::class)]
    public string $status;

    /**
     * The default channels to send to this tenant when has_custom_routing is enabled.
     *
     * @var list<value-of<ChannelClassification>>|null $custom_routing
     */
    #[Optional(list: ChannelClassification::class, nullable: true)]
    public ?array $custom_routing;

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    #[Optional(nullable: true)]
    public ?bool $has_custom_routing;

    /**
     * `new ItemUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemUpdateParams::with(tenant_id: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemUpdateParams)->withTenantID(...)->withStatus(...)
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
     * @param Status|value-of<Status> $status
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $custom_routing
     */
    public static function with(
        string $tenant_id,
        Status|string $status,
        ?array $custom_routing = null,
        ?bool $has_custom_routing = null,
    ): self {
        $obj = new self;

        $obj['tenant_id'] = $tenant_id;
        $obj['status'] = $status;

        null !== $custom_routing && $obj['custom_routing'] = $custom_routing;
        null !== $has_custom_routing && $obj['has_custom_routing'] = $has_custom_routing;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj['tenant_id'] = $tenantID;

        return $obj;
    }

    /**
     * @param Status|value-of<Status> $status
     */
    public function withStatus(Status|string $status): self
    {
        $obj = clone $this;
        $obj['status'] = $status;

        return $obj;
    }

    /**
     * The default channels to send to this tenant when has_custom_routing is enabled.
     *
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public function withCustomRouting(?array $customRouting): self
    {
        $obj = clone $this;
        $obj['custom_routing'] = $customRouting;

        return $obj;
    }

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj['has_custom_routing'] = $hasCustomRouting;

        return $obj;
    }
}
