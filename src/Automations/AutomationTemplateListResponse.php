<?php

declare(strict_types=1);

namespace Courier\Automations;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * @phpstan-import-type AutomationTemplateShape from \Courier\Automations\AutomationTemplate
 *
 * @phpstan-type AutomationTemplateListResponseShape = array{
 *   cursor?: string|null,
 *   templates?: list<AutomationTemplate|AutomationTemplateShape>|null,
 * }
 */
final class AutomationTemplateListResponse implements BaseModel
{
    /** @use SdkModel<AutomationTemplateListResponseShape> */
    use SdkModel;

    /**
     * A cursor token for pagination. Present when there are more results available.
     */
    #[Optional]
    public ?string $cursor;

    /** @var list<AutomationTemplate>|null $templates */
    #[Optional(list: AutomationTemplate::class)]
    public ?array $templates;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<AutomationTemplate|AutomationTemplateShape>|null $templates
     */
    public static function with(
        ?string $cursor = null,
        ?array $templates = null
    ): self {
        $self = new self;

        null !== $cursor && $self['cursor'] = $cursor;
        null !== $templates && $self['templates'] = $templates;

        return $self;
    }

    /**
     * A cursor token for pagination. Present when there are more results available.
     */
    public function withCursor(string $cursor): self
    {
        $self = clone $this;
        $self['cursor'] = $cursor;

        return $self;
    }

    /**
     * @param list<AutomationTemplate|AutomationTemplateShape> $templates
     */
    public function withTemplates(array $templates): self
    {
        $self = clone $this;
        $self['templates'] = $templates;

        return $self;
    }
}
