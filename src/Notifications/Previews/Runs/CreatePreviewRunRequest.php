<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * Request body for creating a preview run of the template in the path. Provide exactly one of `device_set_id` or `device_ids`. The template is the path's `{id}`; a `template_id` here is an unknown key and a 400.
 *
 * @phpstan-type CreatePreviewRunRequestShape = array{
 *   data?: array<string,mixed>|null,
 *   deviceIDs?: list<string>|null,
 *   deviceSetID?: string|null,
 *   locale?: string|null,
 *   templateVersion?: string|null,
 * }
 */
final class CreatePreviewRunRequest implements BaseModel
{
    /** @use SdkModel<CreatePreviewRunRequestShape> */
    use SdkModel;

    /**
     * Template variables to render with, the same shape as the `data` object on a send.
     *
     * @var array<string,mixed>|null $data
     */
    #[Optional(map: 'mixed')]
    public ?array $data;

    /**
     * The devices to render on, by `PreviewDevice.id`, for a one-off run. Mutually exclusive with `device_set_id`.
     *
     * @var list<string>|null $deviceIDs
     */
    #[Optional('device_ids', list: 'string')]
    public ?array $deviceIDs;

    /**
     * A saved device set naming the devices to render on. Mutually exclusive with `device_ids`.
     */
    #[Optional('device_set_id')]
    public ?string $deviceSetID;

    /**
     * Render the template's content for this locale, e.g. "fr-FR".
     */
    #[Optional]
    public ?string $locale;

    /**
     * Which version of the template to render. Omit for the latest saved draft, which always exists and is what the editor shows. `published` renders the live version; a zero-padded `v002` renders that specific publish. Versions are 1-based, so `v000` is not a version, and the unpadded `v2` is rejected — that spelling belongs to journeys' AutomationVersionId, a different scheme in which `v0` means published.
     */
    #[Optional('template_version')]
    public ?string $templateVersion;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed>|null $data
     * @param list<string>|null $deviceIDs
     */
    public static function with(
        ?array $data = null,
        ?array $deviceIDs = null,
        ?string $deviceSetID = null,
        ?string $locale = null,
        ?string $templateVersion = null,
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $deviceIDs && $self['deviceIDs'] = $deviceIDs;
        null !== $deviceSetID && $self['deviceSetID'] = $deviceSetID;
        null !== $locale && $self['locale'] = $locale;
        null !== $templateVersion && $self['templateVersion'] = $templateVersion;

        return $self;
    }

    /**
     * Template variables to render with, the same shape as the `data` object on a send.
     *
     * @param array<string,mixed> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * The devices to render on, by `PreviewDevice.id`, for a one-off run. Mutually exclusive with `device_set_id`.
     *
     * @param list<string> $deviceIDs
     */
    public function withDeviceIDs(array $deviceIDs): self
    {
        $self = clone $this;
        $self['deviceIDs'] = $deviceIDs;

        return $self;
    }

    /**
     * A saved device set naming the devices to render on. Mutually exclusive with `device_ids`.
     */
    public function withDeviceSetID(string $deviceSetID): self
    {
        $self = clone $this;
        $self['deviceSetID'] = $deviceSetID;

        return $self;
    }

    /**
     * Render the template's content for this locale, e.g. "fr-FR".
     */
    public function withLocale(string $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }

    /**
     * Which version of the template to render. Omit for the latest saved draft, which always exists and is what the editor shows. `published` renders the live version; a zero-padded `v002` renders that specific publish. Versions are 1-based, so `v000` is not a version, and the unpadded `v2` is rejected — that spelling belongs to journeys' AutomationVersionId, a different scheme in which `v0` means published.
     */
    public function withTemplateVersion(string $templateVersion): self
    {
        $self = clone $this;
        $self['templateVersion'] = $templateVersion;

        return $self;
    }
}
