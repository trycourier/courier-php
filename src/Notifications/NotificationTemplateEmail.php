<?php

declare(strict_types=1);

namespace Courier\Notifications;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Email header fields for the template's email channel: the From, Reply-to, CC and BCC values set in the Studio email channel settings. Each value may use template variables, such as `{{data.cc}}`, which are resolved at send time.
 * Reads omit `email` when no header is set, and omit each unset field.
 * Writes treat it as optional, with three meanings. Omit it to keep the stored headers. Send null to clear all four. Send an object to replace all four: a field the object leaves out is cleared. Other email channel settings, such as the subject, are kept either way. Headers only apply while `content` has an email channel; with no email channel they are not stored.
 *
 * @phpstan-type NotificationTemplateEmailShape = array{
 *   bcc?: list<string>|null,
 *   cc?: list<string>|null,
 *   from?: string|null,
 *   replyTo?: string|null,
 * }
 */
final class NotificationTemplateEmail implements BaseModel
{
    /** @use SdkModel<NotificationTemplateEmailShape> */
    use SdkModel;

    /**
     * BCC addresses.
     *
     * @var list<string>|null $bcc
     */
    #[Optional(list: 'string')]
    public ?array $bcc;

    /**
     * CC addresses.
     *
     * @var list<string>|null $cc
     */
    #[Optional(list: 'string')]
    public ?array $cc;

    /**
     * The From address.
     */
    #[Optional]
    public ?string $from;

    /**
     * The Reply-to address.
     */
    #[Optional('reply_to')]
    public ?string $replyTo;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $bcc
     * @param list<string>|null $cc
     */
    public static function with(
        ?array $bcc = null,
        ?array $cc = null,
        ?string $from = null,
        ?string $replyTo = null,
    ): self {
        $self = new self;

        null !== $bcc && $self['bcc'] = $bcc;
        null !== $cc && $self['cc'] = $cc;
        null !== $from && $self['from'] = $from;
        null !== $replyTo && $self['replyTo'] = $replyTo;

        return $self;
    }

    /**
     * BCC addresses.
     *
     * @param list<string> $bcc
     */
    public function withBcc(array $bcc): self
    {
        $self = clone $this;
        $self['bcc'] = $bcc;

        return $self;
    }

    /**
     * CC addresses.
     *
     * @param list<string> $cc
     */
    public function withCc(array $cc): self
    {
        $self = clone $this;
        $self['cc'] = $cc;

        return $self;
    }

    /**
     * The From address.
     */
    public function withFrom(string $from): self
    {
        $self = clone $this;
        $self['from'] = $from;

        return $self;
    }

    /**
     * The Reply-to address.
     */
    public function withReplyTo(string $replyTo): self
    {
        $self = clone $this;
        $self['replyTo'] = $replyTo;

        return $self;
    }
}
