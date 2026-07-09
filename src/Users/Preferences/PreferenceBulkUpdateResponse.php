<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\Users\Preferences\PreferenceBulkUpdateResponse\Error;

/**
 * @phpstan-import-type ErrorShape from \Courier\Users\Preferences\PreferenceBulkUpdateResponse\Error
 * @phpstan-import-type BulkPreferenceTopicShape from \Courier\Users\Preferences\BulkPreferenceTopic
 *
 * @phpstan-type PreferenceBulkUpdateResponseShape = array{
 *   errors: list<Error|ErrorShape>,
 *   items: list<BulkPreferenceTopic|BulkPreferenceTopicShape>,
 * }
 */
final class PreferenceBulkUpdateResponse implements BaseModel
{
    /** @use SdkModel<PreferenceBulkUpdateResponseShape> */
    use SdkModel;

    /**
     * The topics that could not be applied, each with a reason.
     *
     * @var list<Error> $errors
     */
    #[Required(list: Error::class)]
    public array $errors;

    /**
     * The topics that were successfully created or updated.
     *
     * @var list<BulkPreferenceTopic> $items
     */
    #[Required(list: BulkPreferenceTopic::class)]
    public array $items;

    /**
     * `new PreferenceBulkUpdateResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceBulkUpdateResponse::with(errors: ..., items: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceBulkUpdateResponse)->withErrors(...)->withItems(...)
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
     * @param list<Error|ErrorShape> $errors
     * @param list<BulkPreferenceTopic|BulkPreferenceTopicShape> $items
     */
    public static function with(array $errors, array $items): self
    {
        $self = new self;

        $self['errors'] = $errors;
        $self['items'] = $items;

        return $self;
    }

    /**
     * The topics that could not be applied, each with a reason.
     *
     * @param list<Error|ErrorShape> $errors
     */
    public function withErrors(array $errors): self
    {
        $self = clone $this;
        $self['errors'] = $errors;

        return $self;
    }

    /**
     * The topics that were successfully created or updated.
     *
     * @param list<BulkPreferenceTopic|BulkPreferenceTopicShape> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }
}
