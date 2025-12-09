<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Required;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;
use Courier\RecipientPreferences;
use Courier\UserRecipient;

/**
 * Ingest user data into a Bulk Job.
 *
 * @see Courier\Services\BulkService::addUsers()
 *
 * @phpstan-type BulkAddUsersParamsShape = array{
 *   users: list<InboundBulkMessageUser|array{
 *     data?: mixed,
 *     preferences?: RecipientPreferences|null,
 *     profile?: mixed,
 *     recipient?: string|null,
 *     to?: UserRecipient|null,
 *   }>,
 * }
 */
final class BulkAddUsersParams implements BaseModel
{
    /** @use SdkModel<BulkAddUsersParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<InboundBulkMessageUser> $users */
    #[Required(list: InboundBulkMessageUser::class)]
    public array $users;

    /**
     * `new BulkAddUsersParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * BulkAddUsersParams::with(users: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new BulkAddUsersParams)->withUsers(...)
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
     * @param list<InboundBulkMessageUser|array{
     *   data?: mixed,
     *   preferences?: RecipientPreferences|null,
     *   profile?: mixed,
     *   recipient?: string|null,
     *   to?: UserRecipient|null,
     * }> $users
     */
    public static function with(array $users): self
    {
        $self = new self;

        $self['users'] = $users;

        return $self;
    }

    /**
     * @param list<InboundBulkMessageUser|array{
     *   data?: mixed,
     *   preferences?: RecipientPreferences|null,
     *   profile?: mixed,
     *   recipient?: string|null,
     *   to?: UserRecipient|null,
     * }> $users
     */
    public function withUsers(array $users): self
    {
        $self = clone $this;
        $self['users'] = $users;

        return $self;
    }
}
