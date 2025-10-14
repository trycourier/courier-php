<?php

declare(strict_types=1);

namespace Courier\Users\Preferences;

use Courier\Core\Attributes\Api;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Concerns\SdkParams;
use Courier\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new PreferenceRetrieveTopicParams); // set properties as needed
 * $client->users.preferences->retrieveTopic(...$params->toArray());
 * ```
 * Fetch user preferences for a specific subscription topic.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->users.preferences->retrieveTopic(...$params->toArray());`
 *
 * @see Courier\Users\Preferences->retrieveTopic
 *
 * @phpstan-type preference_retrieve_topic_params = array{
 *   userID: string, tenantID?: string|null
 * }
 */
final class PreferenceRetrieveTopicParams implements BaseModel
{
    /** @use SdkModel<preference_retrieve_topic_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $userID;

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $tenantID;

    /**
     * `new PreferenceRetrieveTopicParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PreferenceRetrieveTopicParams::with(userID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PreferenceRetrieveTopicParams)->withUserID(...)
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
     */
    public static function with(string $userID, ?string $tenantID = null): self
    {
        $obj = new self;

        $obj->userID = $userID;

        null !== $tenantID && $obj->tenantID = $tenantID;

        return $obj;
    }

    public function withUserID(string $userID): self
    {
        $obj = clone $this;
        $obj->userID = $userID;

        return $obj;
    }

    /**
     * Query the preferences of a user for this specific tenant context.
     */
    public function withTenantID(?string $tenantID): self
    {
        $obj = clone $this;
        $obj->tenantID = $tenantID;

        return $obj;
    }
}
