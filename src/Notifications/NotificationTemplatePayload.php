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
 * Core template fields used in POST and PUT request bodies (nested under a `notification` key) and returned at the top level in responses.
 *
 * @phpstan-import-type BrandShape from \Courier\Notifications\NotificationTemplatePayload\Brand
 * @phpstan-import-type ElementalContentShape from \Courier\ElementalContent
 * @phpstan-import-type RoutingShape from \Courier\Notifications\NotificationTemplatePayload\Routing
 * @phpstan-import-type SubscriptionShape from \Courier\Notifications\NotificationTemplatePayload\Subscription
 * @phpstan-import-type NotificationTemplateEmailShape from \Courier\Notifications\NotificationTemplateEmail
 *
 * @phpstan-type NotificationTemplatePayloadShape = array{
 *   brand: null|Brand|BrandShape,
 *   content: ElementalContent|ElementalContentShape,
 *   name: string,
 *   routing: null|Routing|RoutingShape,
 *   subscription: null|Subscription|SubscriptionShape,
 *   tags: list<string>,
 *   email?: null|NotificationTemplateEmail|NotificationTemplateEmailShape,
 * }
 */
final class NotificationTemplatePayload implements BaseModel
{
    /** @use SdkModel<NotificationTemplatePayloadShape> */
    use SdkModel;

    /**
     * Brand reference, or null for no brand.
     */
    #[Required]
    public ?Brand $brand;

    /**
     * Elemental content definition.
     */
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
     * Email header fields for the template's email channel: the From, Reply-to, CC and BCC values set in the Studio email channel settings. Each value may use template variables, such as `{{data.cc}}`, which are resolved at send time.
     * Reads omit `email` when no header is set, and omit each unset field.
     * Writes treat it as optional, with three meanings. Omit it to keep the stored headers. Send null to clear all four. Send an object to replace all four: a field the object leaves out is cleared. Other email channel settings, such as the subject, are kept either way. Headers only apply while `content` has an email channel; with no email channel they are not stored.
     */
    #[Optional(nullable: true)]
    public ?NotificationTemplateEmail $email;

    /**
     * `new NotificationTemplatePayload()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplatePayload::with(
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
     * (new NotificationTemplatePayload)
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
     * @param NotificationTemplateEmail|NotificationTemplateEmailShape|null $email
     */
    public static function with(
        Brand|array|null $brand,
        ElementalContent|array $content,
        string $name,
        Routing|array|null $routing,
        Subscription|array|null $subscription,
        array $tags,
        NotificationTemplateEmail|array|null $email = null,
    ): self {
        $self = new self;

        $self['brand'] = $brand;
        $self['content'] = $content;
        $self['name'] = $name;
        $self['routing'] = $routing;
        $self['subscription'] = $subscription;
        $self['tags'] = $tags;

        null !== $email && $self['email'] = $email;

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
     * Elemental content definition.
     *
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
     * Email header fields for the template's email channel: the From, Reply-to, CC and BCC values set in the Studio email channel settings. Each value may use template variables, such as `{{data.cc}}`, which are resolved at send time.
     * Reads omit `email` when no header is set, and omit each unset field.
     * Writes treat it as optional, with three meanings. Omit it to keep the stored headers. Send null to clear all four. Send an object to replace all four: a field the object leaves out is cleared. Other email channel settings, such as the subject, are kept either way. Headers only apply while `content` has an email channel; with no email channel they are not stored.
     *
     * @param NotificationTemplateEmail|NotificationTemplateEmailShape|null $email
     */
    public function withEmail(NotificationTemplateEmail|array|null $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }
}
