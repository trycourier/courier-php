<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\ElementalContent;
use Courier\Notifications\NotificationTemplatePayload\Brand;
use Courier\Notifications\NotificationTemplatePayload\Routing;
use Courier\Notifications\NotificationTemplatePayload\Subscription;

/**
 * Template fields accepted in POST and PUT request bodies, nested under a `notification` key.
 *
 * @phpstan-import-type BrandShape from \Courier\Notifications\NotificationTemplatePayload\Brand
 * @phpstan-import-type ElementalContentShape from \Courier\ElementalContent
 * @phpstan-import-type RoutingShape from \Courier\Notifications\NotificationTemplatePayload\Routing
 * @phpstan-import-type SubscriptionShape from \Courier\Notifications\NotificationTemplatePayload\Subscription
 *
 * @phpstan-type NotificationTemplateWritePayloadShape = array{
 *   brand: null|Brand|BrandShape,
 *   content: ElementalContent|ElementalContentShape,
 *   name: string,
 *   routing: null|Routing|RoutingShape,
 *   subscription: null|Subscription|SubscriptionShape,
 *   tags: list<string>,
 *   alias?: string|null,
 * }
 */
final class NotificationTemplateWritePayload implements BaseModel
{
    /** @use SdkModel<NotificationTemplateWritePayloadShape> */
    use SdkModel;

    /**
     * Brand reference, or null for no brand.
     */
    #[Required]
    public ?Brand $brand;

    #[Required]
    public ElementalContent $content;

    /**
     * Display name for the template.
     */
    #[Required]
    public string $name;

    /**
     * Routing strategy reference, or null for none.
     */
    #[Required]
    public ?Routing $routing;

    /**
     * Subscription topic reference, or null for none.
     */
    #[Required]
    public ?Subscription $subscription;

    /**
     * Tags for categorization. Send empty array for none.
     *
     * @var list<string> $tags
     */
    #[Required(list: 'string')]
    public array $tags;

    /**
     * Send-time alias for this template — the value you pass as `event` to POST /send. Writes accept a single alias only.
     * Optional, with three distinct meanings. Omit it to leave any existing aliases untouched. Send a string to make this the template's only alias — a template that already resolved from several aliases keeps just this one and the rest are detached. Send null to remove every alias from the template.
     * An alias may not be claimed by another template — doing so returns 409 — and may not begin with "tenant/".
     */
    #[Optional(nullable: true)]
    public ?string $alias;

    /**
     * `new NotificationTemplateWritePayload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateWritePayload::with(
     *   brand: ...,
     *   content: ...,
     *   name: ...,
     *   routing: ...,
     *   subscription: ...,
     *   tags: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateWritePayload)
     *   ->withBrand(...)
     *   ->withContent(...)
     *   ->withName(...)
     *   ->withRouting(...)
     *   ->withSubscription(...)
     *   ->withTags(...)
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
     * @param Brand|BrandShape|null $brand
     * @param ElementalContent|ElementalContentShape $content
     * @param Routing|RoutingShape|null $routing
     * @param Subscription|SubscriptionShape|null $subscription
     * @param list<string> $tags
     */
    public static function with(
        Brand|array|null $brand,
        ElementalContent|array $content,
        string $name,
        Routing|array|null $routing,
        Subscription|array|null $subscription,
        array $tags,
        ?string $alias = null,
    ): self {
        $self = new self;

        $self['brand'] = $brand;
        $self['content'] = $content;
        $self['name'] = $name;
        $self['routing'] = $routing;
        $self['subscription'] = $subscription;
        $self['tags'] = $tags;

        null !== $alias && $self['alias'] = $alias;

        return $self;
    }

    /**
     * Brand reference, or null for no brand.
     *
     * @param Brand|BrandShape|null $brand
     */
    public function withBrand(Brand|array|null $brand): self
    {
        $self = clone $this;
        $self['brand'] = $brand;

        return $self;
    }

    /**
     * @param ElementalContent|ElementalContentShape $content
     */
    public function withContent(ElementalContent|array $content): self
    {
        $self = clone $this;
        $self['content'] = $content;

        return $self;
    }

    /**
     * Display name for the template.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Routing strategy reference, or null for none.
     *
     * @param Routing|RoutingShape|null $routing
     */
    public function withRouting(Routing|array|null $routing): self
    {
        $self = clone $this;
        $self['routing'] = $routing;

        return $self;
    }

    /**
     * Subscription topic reference, or null for none.
     *
     * @param Subscription|SubscriptionShape|null $subscription
     */
    public function withSubscription(
        Subscription|array|null $subscription
    ): self {
        $self = clone $this;
        $self['subscription'] = $subscription;

        return $self;
    }

    /**
     * Tags for categorization. Send empty array for none.
     *
     * @param list<string> $tags
     */
    public function withTags(array $tags): self
    {
        $self = clone $this;
        $self['tags'] = $tags;

        return $self;
    }

    /**
     * Send-time alias for this template — the value you pass as `event` to POST /send. Writes accept a single alias only.
     * Optional, with three distinct meanings. Omit it to leave any existing aliases untouched. Send a string to make this the template's only alias — a template that already resolved from several aliases keeps just this one and the rest are detached. Send null to remove every alias from the template.
     * An alias may not be claimed by another template — doing so returns 409 — and may not begin with "tenant/".
     */
    public function withAlias(?string $alias): self
    {
        $self = clone $this;
        $self['alias'] = $alias;

        return $self;
    }
}
