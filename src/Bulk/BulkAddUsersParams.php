<?php

declare(strict_types=1);

namespace Courier\Bulk;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * Ingest user data into a Bulk Job.
 *
 * @see Courier\Services\BulkService::addUsers()
 *
 * @phpstan-type BulkAddUsersParamsShape = array{
 *   users: list<InboundBulkMessageUser>
 * }
 */
final class BulkAddUsersParams implements BaseModel
{
    /** @use SdkModel<BulkAddUsersParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<InboundBulkMessageUser> $users */
    #[Api(list: InboundBulkMessageUser::class)]
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
     * @param list<InboundBulkMessageUser> $users
     */
    public static function with(array $users): self
    {
        $obj = new self;

        $obj->users = $users;

        return $obj;
    }

    /**
     * @param list<InboundBulkMessageUser> $users
     */
    public function withUsers(array $users): self
    {
        $obj = clone $this;
        $obj->users = $users;

        return $obj;
    }
}
