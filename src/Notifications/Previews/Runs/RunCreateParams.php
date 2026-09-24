<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Render this template's email content on each of the requested devices.
 *
 * Returns as soon as the run exists and its render is queued — the screenshots are produced asynchronously. Poll `GET /notifications/{id}/previews/runs/{previewRunId}` until every result reaches a terminal status.
 *
 * Name the devices either with `device_set_id`, for a saved set, or with `device_ids`, for a one-off list. Exactly one of the two is required. Inline `device_ids` must be ids listed by `GET /previews/devices`; any other id is a 422, refused before the run exists or is billed.
 *
 * A template that does not exist is a 404. One that exists but cannot be previewed — not a Design Studio template, no email channel, or no such `template_version` — is a 422, also refused before the run exists or is billed.
 *
 * Preview runs are a metered add-on. A workspace without it, or with its billing suspended, receives a 402.
 *
 * @see Courier\Services\Notifications\Previews\RunsService::create()
 *
 * @phpstan-type RunCreateParamsShape = array{
 *   data?: array<string,mixed>|null,
 *   deviceIDs?: list<string>|null,
 *   deviceSetID?: string|null,
 *   locale?: string|null,
 *   templateVersion?: string|null,
 *   idempotencyKey?: string|null,
 *   xIdempotencyExpiration?: string|null,
 * }
 */
final class RunCreateParams implements BaseModel
{
    /** @use SdkModel<RunCreateParamsShape> */
    use SdkModel;
    use SdkParams;

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

    #[Optional]
    public ?string $idempotencyKey;

    #[Optional]
    public ?string $xIdempotencyExpiration;

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
        ?string $idempotencyKey = null,
        ?string $xIdempotencyExpiration = null,
    ): self {
        $self = new self;

        null !== $data && $self['data'] = $data;
        null !== $deviceIDs && $self['deviceIDs'] = $deviceIDs;
        null !== $deviceSetID && $self['deviceSetID'] = $deviceSetID;
        null !== $locale && $self['locale'] = $locale;
        null !== $templateVersion && $self['templateVersion'] = $templateVersion;
        null !== $idempotencyKey && $self['idempotencyKey'] = $idempotencyKey;
        null !== $xIdempotencyExpiration && $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

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

    public function withIdempotencyKey(string $idempotencyKey): self
    {
        $self = clone $this;
        $self['idempotencyKey'] = $idempotencyKey;

        return $self;
    }

    public function withXIdempotencyExpiration(
        string $xIdempotencyExpiration
    ): self {
        $self = clone $this;
        $self['xIdempotencyExpiration'] = $xIdempotencyExpiration;

        return $self;
    }
}
