<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * One render of a template across a set of devices. Billable.
 *
 * @phpstan-type PreviewRunShape = array{
 *   id: string,
 *   createdAt: string,
 *   deviceIDs: list<string>,
 *   status: PreviewRunStatus|value-of<PreviewRunStatus>,
 *   templateID: string,
 *   failureReason?: null|PreviewRunFailureReason|value-of<PreviewRunFailureReason>,
 *   templateVersion?: string|null,
 * }
 */
final class PreviewRun implements BaseModel
{
    /** @use SdkModel<PreviewRunShape> */
    use SdkModel;

    /**
     * Unique identifier for the preview run.
     */
    #[Required]
    public string $id;

    /**
     * ISO-8601 timestamp of when the run was created.
     */
    #[Required('created_at')]
    public string $createdAt;

    /**
     * The devices this run was submitted for, snapshotted when the run was created.
     *
     * @var list<string> $deviceIDs
     */
    #[Required('device_ids', list: 'string')]
    public array $deviceIDs;

    /**
     * Where the run itself has got to. `PENDING` and `RENDERED` mean Courier is still preparing the email, `SUBMITTED` means it is with the rendering service, and `COMPLETED` means every device has reported. `FAILED` is the run as a whole failing — an individual device failing never fails the run.
     *
     * @var value-of<PreviewRunStatus> $status
     */
    #[Required(enum: PreviewRunStatus::class)]
    public string $status;

    /**
     * The template that was rendered.
     */
    #[Required('template_id')]
    public string $templateID;

    /**
     * Why the run failed, when `status` is `FAILED`. `NO_EMAIL_CHANNEL` and `TEMPLATE_NOT_SUPPORTED` mean there was nothing to render; `ALL_DEVICES_UNSUPPORTED` means every requested device has been retired and the request can be fixed by choosing others.
     *
     * @var value-of<PreviewRunFailureReason>|null $failureReason
     */
    #[Optional('failure_reason', enum: PreviewRunFailureReason::class)]
    public ?string $failureReason;

    /**
     * The version of the template that was rendered — `draft`, or a zero-padded published version such as `v002`. Absent until the render settles.
     */
    #[Optional('template_version')]
    public ?string $templateVersion;

    /**
     * `new PreviewRun()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewRun::with(
     *   id: ..., createdAt: ..., deviceIDs: ..., status: ..., templateID: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewRun)
     *   ->withID(...)
     *   ->withCreatedAt(...)
     *   ->withDeviceIDs(...)
     *   ->withStatus(...)
     *   ->withTemplateID(...)
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
     * @param list<string> $deviceIDs
     * @param PreviewRunStatus|value-of<PreviewRunStatus> $status
     * @param PreviewRunFailureReason|value-of<PreviewRunFailureReason>|null $failureReason
     */
    public static function with(
        string $id,
        string $createdAt,
        array $deviceIDs,
        PreviewRunStatus|string $status,
        string $templateID,
        PreviewRunFailureReason|string|null $failureReason = null,
        ?string $templateVersion = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['createdAt'] = $createdAt;
        $self['deviceIDs'] = $deviceIDs;
        $self['status'] = $status;
        $self['templateID'] = $templateID;

        null !== $failureReason && $self['failureReason'] = $failureReason;
        null !== $templateVersion && $self['templateVersion'] = $templateVersion;

        return $self;
    }

    /**
     * Unique identifier for the preview run.
     */
    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * ISO-8601 timestamp of when the run was created.
     */
    public function withCreatedAt(string $createdAt): self
    {
        $self = clone $this;
        $self['createdAt'] = $createdAt;

        return $self;
    }

    /**
     * The devices this run was submitted for, snapshotted when the run was created.
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
     * Where the run itself has got to. `PENDING` and `RENDERED` mean Courier is still preparing the email, `SUBMITTED` means it is with the rendering service, and `COMPLETED` means every device has reported. `FAILED` is the run as a whole failing — an individual device failing never fails the run.
     *
     * @param PreviewRunStatus|value-of<PreviewRunStatus> $status
     */
    public function withStatus(PreviewRunStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * The template that was rendered.
     */
    public function withTemplateID(string $templateID): self
    {
        $self = clone $this;
        $self['templateID'] = $templateID;

        return $self;
    }

    /**
     * Why the run failed, when `status` is `FAILED`. `NO_EMAIL_CHANNEL` and `TEMPLATE_NOT_SUPPORTED` mean there was nothing to render; `ALL_DEVICES_UNSUPPORTED` means every requested device has been retired and the request can be fixed by choosing others.
     *
     * @param PreviewRunFailureReason|value-of<PreviewRunFailureReason> $failureReason
     */
    public function withFailureReason(
        PreviewRunFailureReason|string $failureReason
    ): self {
        $self = clone $this;
        $self['failureReason'] = $failureReason;

        return $self;
    }

    /**
     * The version of the template that was rendered — `draft`, or a zero-padded published version such as `v002`. Absent until the render settles.
     */
    public function withTemplateVersion(string $templateVersion): self
    {
        $self = clone $this;
        $self['templateVersion'] = $templateVersion;

        return $self;
    }
}
