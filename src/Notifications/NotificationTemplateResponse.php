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
use Courier\Notifications\NotificationTemplateResponse\State;

/**
 * Response for GET /notifications/{id}, POST /notifications, and PUT /notifications/{id}. Returns all template fields at the top level.
 *
 * @phpstan-import-type NotificationTemplateAliasVariants from \Courier\Notifications\NotificationTemplateAlias
 * @phpstan-import-type BrandShape from \Courier\Notifications\NotificationTemplatePayload\Brand
 * @phpstan-import-type ElementalContentShape from \Courier\ElementalContent
 * @phpstan-import-type RoutingShape from \Courier\Notifications\NotificationTemplatePayload\Routing
 * @phpstan-import-type SubscriptionShape from \Courier\Notifications\NotificationTemplatePayload\Subscription
 * @phpstan-import-type NotificationTemplateEmailShape from \Courier\Notifications\NotificationTemplateEmail
 * @phpstan-import-type NotificationTemplateAliasShape from \Courier\Notifications\NotificationTemplateAlias
 *
 * @phpstan-type NotificationTemplateResponseShape = array{
 *   brand: null|Brand|BrandShape,
 *   content: ElementalContent|ElementalContentShape,
 *   name: string,
 *   routing: null|Routing|RoutingShape,
 *   subscription: null|Subscription|SubscriptionShape,
 *   tags: list<string>,
 *   email?: null|NotificationTemplateEmail|NotificationTemplateEmailShape,
 *   id: string,
 *   created: int,
 *   creator: string,
 *   state: State|value-of<State>,
 *   alias?: NotificationTemplateAliasShape|null,
 *   updated?: int|null,
 *   updater?: string|null,
 * }
 */
final class NotificationTemplateResponse implements BaseModel
{
    /** @use SdkModel<NotificationTemplateResponseShape> */
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
     * Email header fields for the template's email channel: the From, Reply-to, CC and BCC values set in the Studio email channel settings. Each value may use template variables, such as `{{data.cc}}`, which are resolved at send time.
     * Reads omit `email` when no header is set, and omit each unset field.
     * Writes treat it as optional, with three meanings. Omit it to keep the stored headers. Send null to clear all four. Send an object to replace all four: a field the object leaves out is cleared. Other email channel settings, such as the subject, are kept either way. Headers only apply while `content` has an email channel; with no email channel they are not stored.
     */
    #[Optional(nullable: true)]
    public ?NotificationTemplateEmail $email;

    /**
     * The template ID.
     */
    #[Required]
    public string $id;

    /**
     * Epoch milliseconds when the template was created.
     */
    #[Required]
    public int $created;

    /**
     * User ID of the creator.
     */
    #[Required]
    public string $creator;

    /**
     * The template state. Always uppercase.
     *
     * @var value-of<State> $state
     */
    #[Required(enum: State::class)]
    public string $state;

    /**
     * A template's send-time alias as returned by a read, omitted entirely when it has none. Usually a single string; an array for a template that resolves from several aliases, which writes through this API can no longer produce — only templates predating that restriction, or aliases attached outside this API, hold more than one.
     *
     * @var NotificationTemplateAliasVariants|null $alias
     */
    #[Optional(union: NotificationTemplateAlias::class)]
    public string|array|null $alias;

    /**
     * Epoch milliseconds of last update.
     */
    #[Optional]
    public ?int $updated;

    /**
     * User ID of the last updater.
     */
    #[Optional]
    public ?string $updater;

    /**
     * `new NotificationTemplateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * NotificationTemplateResponse::with(
     *   brand: ...,
     *   content: ...,
     *   name: ...,
     *   routing: ...,
     *   subscription: ...,
     *   tags: ...,
     *   id: ...,
     *   created: ...,
     *   creator: ...,
     *   state: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new NotificationTemplateResponse)
     *   ->withBrand(...)
     *   ->withContent(...)
     *   ->withName(...)
     *   ->withRouting(...)
     *   ->withSubscription(...)
     *   ->withTags(...)
     *   ->withID(...)
     *   ->withCreated(...)
     *   ->withCreator(...)
     *   ->withState(...)
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
     * @param State|value-of<State> $state
     * @param NotificationTemplateEmail|NotificationTemplateEmailShape|null $email
     * @param NotificationTemplateAliasShape|null $alias
     */
    public static function with(
        Brand|array|null $brand,
        ElementalContent|array $content,
        string $name,
        Routing|array|null $routing,
        Subscription|array|null $subscription,
        array $tags,
        string $id,
        int $created,
        string $creator,
        State|string $state,
        NotificationTemplateEmail|array|null $email = null,
        string|array|null $alias = null,
        ?int $updated = null,
        ?string $updater = null,
    ): self {
        $self = new self;

        $self['brand'] = $brand;
        $self['content'] = $content;
        $self['name'] = $name;
        $self['routing'] = $routing;
        $self['subscription'] = $subscription;
        $self['tags'] = $tags;
        $self['id'] = $id;
        $self['created'] = $created;
        $self['creator'] = $creator;
        $self['state'] = $state;

        null !== $email && $self['email'] = $email;
        null !== $alias && $self['alias'] = $alias;
        null !== $updated && $self['updated'] = $updated;
        null !== $updater && $self['updater'] = $updater;

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

    /**
     * The template ID.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * Epoch milliseconds when the template was created.
     */
    public function withCreated(int $created): self
    {
        $self = clone $this;
        $self['created'] = $created;

        return $self;
    }

    /**
     * User ID of the creator.
     */
    public function withCreator(string $creator): self
    {
        $self = clone $this;
        $self['creator'] = $creator;

        return $self;
    }

    /**
     * The template state. Always uppercase.
     *
     * @param State|value-of<State> $state
     */
    public function withState(State|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * A template's send-time alias as returned by a read, omitted entirely when it has none. Usually a single string; an array for a template that resolves from several aliases, which writes through this API can no longer produce — only templates predating that restriction, or aliases attached outside this API, hold more than one.
     *
     * @param NotificationTemplateAliasShape $alias
     */
    public function withAlias(string|array $alias): self
    {
        $self = clone $this;
        $self['alias'] = $alias;

        return $self;
    }

    /**
     * Epoch milliseconds of last update.
     */
    public function withUpdated(int $updated): self
    {
        $self = clone $this;
        $self['updated'] = $updated;

        return $self;
    }

    /**
     * User ID of the last updater.
     */
    public function withUpdater(string $updater): self
    {
        $self = clone $this;
        $self['updater'] = $updater;

        return $self;
    }
}
