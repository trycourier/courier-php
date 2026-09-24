<?php

declare(strict_types=1);

namespace Courier\Notifications\Previews\Runs;

use Courier\Core\Attributes\Optional;
use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;

/**
 * One device's result within a preview run.
 *
 * @phpstan-type PreviewResultShape = array{
 *   deviceID: string,
 *   screenshotURL: string|null,
 *   status: PreviewResultStatus|value-of<PreviewResultStatus>,
 *   thumbnailURL: string|null,
 *   failureReason?: null|PreviewResultFailureReason|value-of<PreviewResultFailureReason>,
 * }
 */
final class PreviewResult implements BaseModel
{
    /** @use SdkModel<PreviewResultShape> */
    use SdkModel;

    /**
     * The device this result is for, by `PreviewDevice.id`.
     */
    #[Required('device_id')]
    public string $deviceID;

    /**
     * Short-lived signed URL for the full-sized image. Null until the screenshot exists. Re-signed on every read, so fetch it rather than storing it.
     */
    #[Required('screenshot_url')]
    public ?string $screenshotURL;

    /**
     * One device's outcome. `COMPLETED` means the screenshot exists and its URLs are populated. `UNSUPPORTED`, `TIMED_OUT` and `FAILED` are all terminal, and none stands in for another — `UNSUPPORTED` means the device was retired at the vendor, `TIMED_OUT` means it did not report in time.
     *
     * @var value-of<PreviewResultStatus> $status
     */
    #[Required(enum: PreviewResultStatus::class)]
    public string $status;

    /**
     * Short-lived signed URL for the grid-sized image. Null until the screenshot exists. Re-signed on every read, so fetch it rather than storing it.
     */
    #[Required('thumbnail_url')]
    public ?string $thumbnailURL;

    /**
     * Why one device's render failed, when its `status` is `FAILED` and the cause has a public name. `DELIVERY_FAILED` means the rendering service could not deliver the message to its own capture mailbox — infrastructure, not anything wrong with the template.
     *
     * @var value-of<PreviewResultFailureReason>|null $failureReason
     */
    #[Optional('failure_reason', enum: PreviewResultFailureReason::class)]
    public ?string $failureReason;

    /**
     * `new PreviewResult()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreviewResult::with(
     *   deviceID: ..., screenshotURL: ..., status: ..., thumbnailURL: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreviewResult)
     *   ->withDeviceID(...)
     *   ->withScreenshotURL(...)
     *   ->withStatus(...)
     *   ->withThumbnailURL(...)
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
     * @param PreviewResultStatus|value-of<PreviewResultStatus> $status
     * @param PreviewResultFailureReason|value-of<PreviewResultFailureReason>|null $failureReason
     */
    public static function with(
        string $deviceID,
        ?string $screenshotURL,
        PreviewResultStatus|string $status,
        ?string $thumbnailURL,
        PreviewResultFailureReason|string|null $failureReason = null,
    ): self {
        $self = new self;

        $self['deviceID'] = $deviceID;
        $self['screenshotURL'] = $screenshotURL;
        $self['status'] = $status;
        $self['thumbnailURL'] = $thumbnailURL;

        null !== $failureReason && $self['failureReason'] = $failureReason;

        return $self;
    }

    /**
     * The device this result is for, by `PreviewDevice.id`.
     */
    public function withDeviceID(string $deviceID): self
    {
        $self = clone $this;
        $self['deviceID'] = $deviceID;

        return $self;
    }

    /**
     * Short-lived signed URL for the full-sized image. Null until the screenshot exists. Re-signed on every read, so fetch it rather than storing it.
     */
    public function withScreenshotURL(?string $screenshotURL): self
    {
        $self = clone $this;
        $self['screenshotURL'] = $screenshotURL;

        return $self;
    }

    /**
     * One device's outcome. `COMPLETED` means the screenshot exists and its URLs are populated. `UNSUPPORTED`, `TIMED_OUT` and `FAILED` are all terminal, and none stands in for another — `UNSUPPORTED` means the device was retired at the vendor, `TIMED_OUT` means it did not report in time.
     *
     * @param PreviewResultStatus|value-of<PreviewResultStatus> $status
     */
    public function withStatus(PreviewResultStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Short-lived signed URL for the grid-sized image. Null until the screenshot exists. Re-signed on every read, so fetch it rather than storing it.
     */
    public function withThumbnailURL(?string $thumbnailURL): self
    {
        $self = clone $this;
        $self['thumbnailURL'] = $thumbnailURL;

        return $self;
    }

    /**
     * Why one device's render failed, when its `status` is `FAILED` and the cause has a public name. `DELIVERY_FAILED` means the rendering service could not deliver the message to its own capture mailbox — infrastructure, not anything wrong with the template.
     *
     * @param PreviewResultFailureReason|value-of<PreviewResultFailureReason> $failureReason
     */
    public function withFailureReason(
        PreviewResultFailureReason|string $failureReason
    ): self {
        $self = clone $this;
        $self['failureReason'] = $failureReason;

        return $self;
    }
}
