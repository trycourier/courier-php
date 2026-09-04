<?php

declare(strict_types=1);

namespace Courier\Brands;

use Courier\Brands\EmailFooter\Social;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type SocialShape from \Courier\Brands\EmailFooter\Social
 *
 * @phpstan-type EmailFooterShape = array{
 *   inheritDefault?: bool|null,
 *   markdown?: string|null,
 *   social?: null|Social|SocialShape,
 * }
 */
final class EmailFooter implements BaseModel
{
    /** @use SdkModel<EmailFooterShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?bool $inheritDefault;

    /**
     * The footer body, as markdown. This is the field the API returns and accepts; it is omitted entirely when no footer body is set. Sending null is accepted and treated as no footer body.
     */
    #[Optional(nullable: true)]
    public ?string $markdown;

    /**
     * Social links rendered in the email footer.
     */
    #[Optional(nullable: true)]
    public ?Social $social;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Social|SocialShape|null $social
     */
    public static function with(
        ?bool $inheritDefault = null,
        ?string $markdown = null,
        Social|array|null $social = null,
    ): self {
        $self = new self;

        null !== $inheritDefault && $self['inheritDefault'] = $inheritDefault;
        null !== $markdown && $self['markdown'] = $markdown;
        null !== $social && $self['social'] = $social;

        return $self;
    }

    public function withInheritDefault(?bool $inheritDefault): self
    {
        $self = clone $this;
        $self['inheritDefault'] = $inheritDefault;

        return $self;
    }

    /**
     * The footer body, as markdown. This is the field the API returns and accepts; it is omitted entirely when no footer body is set. Sending null is accepted and treated as no footer body.
     */
    public function withMarkdown(?string $markdown): self
    {
        $self = clone $this;
        $self['markdown'] = $markdown;

        return $self;
    }

    /**
     * Social links rendered in the email footer.
     *
     * @param Social|SocialShape|null $social
     */
    public function withSocial(Social|array|null $social): self
    {
        $self = clone $this;
        $self['social'] = $social;

        return $self;
    }
}
