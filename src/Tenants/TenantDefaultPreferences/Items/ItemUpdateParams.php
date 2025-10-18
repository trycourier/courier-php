<?php

declare(strict_types=1);

namespace Courier\Tenants\TenantDefaultPreferences\Items;

use Courier\ChannelClassification;
use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\Tenants\TenantDefaultPreferences\Items\ItemUpdateParams\Status;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new ItemUpdateParams); // set properties as needed
 * $client->tenants.tenantDefaultPreferences.items->update(...$params->toArray());
 * ```
 * Create or Replace Default Preferences For Topic.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->tenants.tenantDefaultPreferences.items->update(...$params->toArray());`
 *
 * @see Courier\Tenants\TenantDefaultPreferences\Items->update
 *
 * @phpstan-type item_update_params = array{
 *   tenantID: string,
 *   status: Status|value-of<Status>,
 *   customRouting?: list<ChannelClassification|value-of<ChannelClassification>>|null,
 *   hasCustomRouting?: bool|null,
 * }
 */
final class ItemUpdateParams implements BaseModel
{
    /** @use SdkModel<item_update_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $tenantID;

    /** @var value-of<Status> $status */
    #[Api(enum: Status::class)]
    public string $status;

    /**
     * The default channels to send to this tenant when has_custom_routing is enabled.
     *
     * @var list<value-of<ChannelClassification>>|null $customRouting
     */
    #[Api(
        'custom_routing',
        list: ChannelClassification::class,
        nullable: true,
        optional: true,
    )]
    public ?array $customRouting;

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    #[Api('has_custom_routing', nullable: true, optional: true)]
    public ?bool $hasCustomRouting;

    /**
     * `new ItemUpdateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemUpdateParams::with(tenantID: ..., status: ...)
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
     * @param list<ChannelClassification|value-of<ChannelClassification>>|null $customRouting
     */
    public static function with(
        string $tenantID,
        Status|string $status,
        ?array $customRouting = null,
        ?bool $hasCustomRouting = null,
    ): self {
        $obj = new self;

        $obj->tenantID = $tenantID;
        $obj['status'] = $status;

        null !== $customRouting && $obj['customRouting'] = $customRouting;
        null !== $hasCustomRouting && $obj->hasCustomRouting = $hasCustomRouting;

        return $obj;
    }

    public function withTenantID(string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

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
        $obj['customRouting'] = $customRouting;

        return $obj;
    }

    /**
     * Override channel routing with custom preferences. This will override any template prefernces that are set, but a user can still customize their preferences.
     */
    public function withHasCustomRouting(?bool $hasCustomRouting): self
    {
        $obj = clone $this;
        $obj->hasCustomRouting = $hasCustomRouting;

        return $obj;
    }
}
