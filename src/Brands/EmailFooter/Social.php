<?php

declare(strict_types=1);

namespace Courier\Brands\EmailFooter;

use Courier\Brands\EmailFooter\Social\Facebook;
use Courier\Brands\EmailFooter\Social\Instagram;
use Courier\Brands\EmailFooter\Social\Linkedin;
use Courier\Brands\EmailFooter\Social\Medium;
use Courier\Brands\EmailFooter\Social\Twitter;
use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Social links rendered in the email footer.
 *
 * @phpstan-import-type FacebookShape from \Courier\Brands\EmailFooter\Social\Facebook
 * @phpstan-import-type InstagramShape from \Courier\Brands\EmailFooter\Social\Instagram
 * @phpstan-import-type LinkedinShape from \Courier\Brands\EmailFooter\Social\Linkedin
 * @phpstan-import-type MediumShape from \Courier\Brands\EmailFooter\Social\Medium
 * @phpstan-import-type TwitterShape from \Courier\Brands\EmailFooter\Social\Twitter
 *
 * @phpstan-type SocialShape = array{
 *   facebook?: null|Facebook|FacebookShape,
 *   instagram?: null|Instagram|InstagramShape,
 *   linkedin?: null|Linkedin|LinkedinShape,
 *   medium?: null|Medium|MediumShape,
 *   twitter?: null|Twitter|TwitterShape,
 * }
 */
final class Social implements BaseModel
{
    /** @use SdkModel<SocialShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?Facebook $facebook;

    #[Optional(nullable: true)]
    public ?Instagram $instagram;

    #[Optional(nullable: true)]
    public ?Linkedin $linkedin;

    #[Optional(nullable: true)]
    public ?Medium $medium;

    #[Optional(nullable: true)]
    public ?Twitter $twitter;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Facebook|FacebookShape|null $facebook
     * @param Instagram|InstagramShape|null $instagram
     * @param Linkedin|LinkedinShape|null $linkedin
     * @param Medium|MediumShape|null $medium
     * @param Twitter|TwitterShape|null $twitter
     */
    public static function with(
        Facebook|array|null $facebook = null,
        Instagram|array|null $instagram = null,
        Linkedin|array|null $linkedin = null,
        Medium|array|null $medium = null,
        Twitter|array|null $twitter = null,
    ): self {
        $self = new self;

        null !== $facebook && $self['facebook'] = $facebook;
        null !== $instagram && $self['instagram'] = $instagram;
        null !== $linkedin && $self['linkedin'] = $linkedin;
        null !== $medium && $self['medium'] = $medium;
        null !== $twitter && $self['twitter'] = $twitter;

        return $self;
    }

    /**
     * @param Facebook|FacebookShape|null $facebook
     */
    public function withFacebook(Facebook|array|null $facebook): self
    {
        $self = clone $this;
        $self['facebook'] = $facebook;

        return $self;
    }

    /**
     * @param Instagram|InstagramShape|null $instagram
     */
    public function withInstagram(Instagram|array|null $instagram): self
    {
        $self = clone $this;
        $self['instagram'] = $instagram;

        return $self;
    }

    /**
     * @param Linkedin|LinkedinShape|null $linkedin
     */
    public function withLinkedin(Linkedin|array|null $linkedin): self
    {
        $self = clone $this;
        $self['linkedin'] = $linkedin;

        return $self;
    }

    /**
     * @param Medium|MediumShape|null $medium
     */
    public function withMedium(Medium|array|null $medium): self
    {
        $self = clone $this;
        $self['medium'] = $medium;

        return $self;
    }

    /**
     * @param Twitter|TwitterShape|null $twitter
     */
    public function withTwitter(Twitter|array|null $twitter): self
    {
        $self = clone $this;
        $self['twitter'] = $twitter;

        return $self;
    }
}
