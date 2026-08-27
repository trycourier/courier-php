<?php

declare(strict_types=1);

namespace Courier;

use Courier\Core\Attributes\Optional;
use Courier\Core\Concerns\SdkModel;
use Courier\Core\Contracts\BaseModel;
use Courier\UserProfile\Address;

/**
 * @phpstan-import-type ApnVariants from \Courier\Apn
 * @phpstan-import-type DiscordVariants from \Courier\Discord
 * @phpstan-import-type ExpoVariants from \Courier\Expo
 * @phpstan-import-type UserProfileFirebaseTokenVariants from \Courier\UserProfileFirebaseToken
 * @phpstan-import-type MsTeamsVariants from \Courier\MsTeams
 * @phpstan-import-type SlackVariants from \Courier\Slack
 * @phpstan-import-type AddressShape from \Courier\UserProfile\Address
 * @phpstan-import-type AirshipProfileShape from \Courier\AirshipProfile
 * @phpstan-import-type ApnShape from \Courier\Apn
 * @phpstan-import-type AwsSnsShape from \Courier\AwsSns
 * @phpstan-import-type DiscordShape from \Courier\Discord
 * @phpstan-import-type ExpoShape from \Courier\Expo
 * @phpstan-import-type UserProfileFirebaseTokenShape from \Courier\UserProfileFirebaseToken
 * @phpstan-import-type IntercomShape from \Courier\Intercom
 * @phpstan-import-type MsTeamsShape from \Courier\MsTeams
 * @phpstan-import-type SlackShape from \Courier\Slack
 *
 * @phpstan-type UserProfileShape = array{
 *   address?: null|Address|AddressShape,
 *   airship?: null|AirshipProfile|AirshipProfileShape,
 *   apn?: ApnShape|null,
 *   awsSns?: null|AwsSns|AwsSnsShape,
 *   birthdate?: string|null,
 *   custom?: array<string,mixed>|null,
 *   discord?: DiscordShape|null,
 *   email?: string|null,
 *   emailVerified?: bool|null,
 *   expo?: ExpoShape|null,
 *   facebookPsid?: string|null,
 *   familyName?: string|null,
 *   firebaseToken?: UserProfileFirebaseTokenShape|null,
 *   gender?: string|null,
 *   givenName?: string|null,
 *   intercom?: null|Intercom|IntercomShape,
 *   locale?: string|null,
 *   middleName?: string|null,
 *   msTeams?: MsTeamsShape|null,
 *   name?: string|null,
 *   nickname?: string|null,
 *   phoneNumber?: string|null,
 *   phoneNumberVerified?: bool|null,
 *   picture?: string|null,
 *   preferredName?: string|null,
 *   profile?: string|null,
 *   slack?: SlackShape|null,
 *   sub?: string|null,
 *   updatedAt?: string|null,
 *   website?: string|null,
 *   zoneinfo?: string|null,
 * }
 */
final class UserProfile implements BaseModel
{
    /** @use SdkModel<UserProfileShape> */
    use SdkModel;

    #[Optional(nullable: true)]
    public ?Address $address;

    #[Optional(nullable: true)]
    public ?AirshipProfile $airship;

    /**
     * Apple Push Notification device tokens. Supply either a single `token` or a `tokens` value. A bare string is rejected by the provider — the token must be wrapped in this object.
     *
     * @var ApnVariants|null $apn
     */
    #[Optional(nullable: true)]
    public Token|MultipleTokens|null $apn;

    /**
     * Routes a push notification through the AWS SNS provider. The target ARN must be nested under `aws_sns` — a top-level `target_arn` on the profile is ignored by the provider.
     */
    #[Optional('aws_sns', nullable: true)]
    public ?AwsSns $awsSns;

    #[Optional(nullable: true)]
    public ?string $birthdate;

    /**
     * A free form object. Due to a limitation of the API Explorer, you can only enter string key/values below, but this API accepts more complex object structures.
     *
     * @var array<string,mixed>|null $custom
     */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $custom;

    /** @var DiscordVariants|null $discord */
    #[Optional(nullable: true)]
    public SendToChannel|SendDirectMessage|null $discord;

    #[Optional(nullable: true)]
    public ?string $email;

    #[Optional('email_verified', nullable: true)]
    public ?bool $emailVerified;

    /**
     * Expo push tokens. Supply either a single `token` or a `tokens` value.
     *
     * @var ExpoVariants|null $expo
     */
    #[Optional(nullable: true)]
    public Token|MultipleTokens|null $expo;

    #[Optional('facebookPSID', nullable: true)]
    public ?string $facebookPsid;

    #[Optional('family_name', nullable: true)]
    public ?string $familyName;

    /** @var UserProfileFirebaseTokenVariants|null $firebaseToken */
    #[Optional(union: UserProfileFirebaseToken::class, nullable: true)]
    public string|array|null $firebaseToken;

    #[Optional(nullable: true)]
    public ?string $gender;

    #[Optional('given_name', nullable: true)]
    public ?string $givenName;

    #[Optional(nullable: true)]
    public ?Intercom $intercom;

    #[Optional(nullable: true)]
    public ?string $locale;

    #[Optional('middle_name', nullable: true)]
    public ?string $middleName;

    /**
     * Provide at least one of `tenant_id` or `service_url`. If you provide both, they must agree.
     *
     * @var MsTeamsVariants|null $msTeams
     */
    #[Optional('ms_teams', nullable: true)]
    public SendToMsTeamsUserID|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName|null $msTeams;

    #[Optional(nullable: true)]
    public ?string $name;

    #[Optional(nullable: true)]
    public ?string $nickname;

    #[Optional('phone_number', nullable: true)]
    public ?string $phoneNumber;

    #[Optional('phone_number_verified', nullable: true)]
    public ?bool $phoneNumberVerified;

    #[Optional(nullable: true)]
    public ?string $picture;

    #[Optional('preferred_name', nullable: true)]
    public ?string $preferredName;

    #[Optional(nullable: true)]
    public ?string $profile;

    /** @var SlackVariants|null $slack */
    #[Optional(nullable: true)]
    public SendToSlackChannel|SendToSlackEmail|SendToSlackUserID|null $slack;

    #[Optional(nullable: true)]
    public ?string $sub;

    #[Optional('updated_at', nullable: true)]
    public ?string $updatedAt;

    #[Optional(nullable: true)]
    public ?string $website;

    #[Optional(nullable: true)]
    public ?string $zoneinfo;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Address|AddressShape|null $address
     * @param AirshipProfile|AirshipProfileShape|null $airship
     * @param ApnShape|null $apn
     * @param AwsSns|AwsSnsShape|null $awsSns
     * @param array<string,mixed>|null $custom
     * @param DiscordShape|null $discord
     * @param ExpoShape|null $expo
     * @param UserProfileFirebaseTokenShape|null $firebaseToken
     * @param Intercom|IntercomShape|null $intercom
     * @param MsTeamsShape|null $msTeams
     * @param SlackShape|null $slack
     */
    public static function with(
        Address|array|null $address = null,
        AirshipProfile|array|null $airship = null,
        Token|array|MultipleTokens|null $apn = null,
        AwsSns|array|null $awsSns = null,
        ?string $birthdate = null,
        ?array $custom = null,
        SendToChannel|array|SendDirectMessage|null $discord = null,
        ?string $email = null,
        ?bool $emailVerified = null,
        Token|array|MultipleTokens|null $expo = null,
        ?string $facebookPsid = null,
        ?string $familyName = null,
        string|array|null $firebaseToken = null,
        ?string $gender = null,
        ?string $givenName = null,
        Intercom|array|null $intercom = null,
        ?string $locale = null,
        ?string $middleName = null,
        SendToMsTeamsUserID|array|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName|null $msTeams = null,
        ?string $name = null,
        ?string $nickname = null,
        ?string $phoneNumber = null,
        ?bool $phoneNumberVerified = null,
        ?string $picture = null,
        ?string $preferredName = null,
        ?string $profile = null,
        SendToSlackChannel|array|SendToSlackEmail|SendToSlackUserID|null $slack = null,
        ?string $sub = null,
        ?string $updatedAt = null,
        ?string $website = null,
        ?string $zoneinfo = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $airship && $self['airship'] = $airship;
        null !== $apn && $self['apn'] = $apn;
        null !== $awsSns && $self['awsSns'] = $awsSns;
        null !== $birthdate && $self['birthdate'] = $birthdate;
        null !== $custom && $self['custom'] = $custom;
        null !== $discord && $self['discord'] = $discord;
        null !== $email && $self['email'] = $email;
        null !== $emailVerified && $self['emailVerified'] = $emailVerified;
        null !== $expo && $self['expo'] = $expo;
        null !== $facebookPsid && $self['facebookPsid'] = $facebookPsid;
        null !== $familyName && $self['familyName'] = $familyName;
        null !== $firebaseToken && $self['firebaseToken'] = $firebaseToken;
        null !== $gender && $self['gender'] = $gender;
        null !== $givenName && $self['givenName'] = $givenName;
        null !== $intercom && $self['intercom'] = $intercom;
        null !== $locale && $self['locale'] = $locale;
        null !== $middleName && $self['middleName'] = $middleName;
        null !== $msTeams && $self['msTeams'] = $msTeams;
        null !== $name && $self['name'] = $name;
        null !== $nickname && $self['nickname'] = $nickname;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $phoneNumberVerified && $self['phoneNumberVerified'] = $phoneNumberVerified;
        null !== $picture && $self['picture'] = $picture;
        null !== $preferredName && $self['preferredName'] = $preferredName;
        null !== $profile && $self['profile'] = $profile;
        null !== $slack && $self['slack'] = $slack;
        null !== $sub && $self['sub'] = $sub;
        null !== $updatedAt && $self['updatedAt'] = $updatedAt;
        null !== $website && $self['website'] = $website;
        null !== $zoneinfo && $self['zoneinfo'] = $zoneinfo;

        return $self;
    }

    /**
     * @param Address|AddressShape|null $address
     */
    public function withAddress(Address|array|null $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * @param AirshipProfile|AirshipProfileShape|null $airship
     */
    public function withAirship(AirshipProfile|array|null $airship): self
    {
        $self = clone $this;
        $self['airship'] = $airship;

        return $self;
    }

    /**
     * Apple Push Notification device tokens. Supply either a single `token` or a `tokens` value. A bare string is rejected by the provider — the token must be wrapped in this object.
     *
     * @param ApnShape|null $apn
     */
    public function withApn(Token|array|MultipleTokens|null $apn): self
    {
        $self = clone $this;
        $self['apn'] = $apn;

        return $self;
    }

    /**
     * Routes a push notification through the AWS SNS provider. The target ARN must be nested under `aws_sns` — a top-level `target_arn` on the profile is ignored by the provider.
     *
     * @param AwsSns|AwsSnsShape|null $awsSns
     */
    public function withAwsSns(AwsSns|array|null $awsSns): self
    {
        $self = clone $this;
        $self['awsSns'] = $awsSns;

        return $self;
    }

    public function withBirthdate(?string $birthdate): self
    {
        $self = clone $this;
        $self['birthdate'] = $birthdate;

        return $self;
    }

    /**
     * A free form object. Due to a limitation of the API Explorer, you can only enter string key/values below, but this API accepts more complex object structures.
     *
     * @param array<string,mixed>|null $custom
     */
    public function withCustom(?array $custom): self
    {
        $self = clone $this;
        $self['custom'] = $custom;

        return $self;
    }

    /**
     * @param DiscordShape|null $discord
     */
    public function withDiscord(
        SendToChannel|array|SendDirectMessage|null $discord
    ): self {
        $self = clone $this;
        $self['discord'] = $discord;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withEmailVerified(?bool $emailVerified): self
    {
        $self = clone $this;
        $self['emailVerified'] = $emailVerified;

        return $self;
    }

    /**
     * Expo push tokens. Supply either a single `token` or a `tokens` value.
     *
     * @param ExpoShape|null $expo
     */
    public function withExpo(Token|array|MultipleTokens|null $expo): self
    {
        $self = clone $this;
        $self['expo'] = $expo;

        return $self;
    }

    public function withFacebookPsid(?string $facebookPsid): self
    {
        $self = clone $this;
        $self['facebookPsid'] = $facebookPsid;

        return $self;
    }

    public function withFamilyName(?string $familyName): self
    {
        $self = clone $this;
        $self['familyName'] = $familyName;

        return $self;
    }

    /**
     * @param UserProfileFirebaseTokenShape|null $firebaseToken
     */
    public function withFirebaseToken(string|array|null $firebaseToken): self
    {
        $self = clone $this;
        $self['firebaseToken'] = $firebaseToken;

        return $self;
    }

    public function withGender(?string $gender): self
    {
        $self = clone $this;
        $self['gender'] = $gender;

        return $self;
    }

    public function withGivenName(?string $givenName): self
    {
        $self = clone $this;
        $self['givenName'] = $givenName;

        return $self;
    }

    /**
     * @param Intercom|IntercomShape|null $intercom
     */
    public function withIntercom(Intercom|array|null $intercom): self
    {
        $self = clone $this;
        $self['intercom'] = $intercom;

        return $self;
    }

    public function withLocale(?string $locale): self
    {
        $self = clone $this;
        $self['locale'] = $locale;

        return $self;
    }

    public function withMiddleName(?string $middleName): self
    {
        $self = clone $this;
        $self['middleName'] = $middleName;

        return $self;
    }

    /**
     * Provide at least one of `tenant_id` or `service_url`. If you provide both, they must agree.
     *
     * @param MsTeamsShape|null $msTeams
     */
    public function withMsTeams(
        SendToMsTeamsUserID|array|SendToMsTeamsEmail|SendToMsTeamsChannelID|SendToMsTeamsConversationID|SendToMsTeamsChannelName|null $msTeams,
    ): self {
        $self = clone $this;
        $self['msTeams'] = $msTeams;

        return $self;
    }

    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    public function withNickname(?string $nickname): self
    {
        $self = clone $this;
        $self['nickname'] = $nickname;

        return $self;
    }

    public function withPhoneNumber(?string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    public function withPhoneNumberVerified(?bool $phoneNumberVerified): self
    {
        $self = clone $this;
        $self['phoneNumberVerified'] = $phoneNumberVerified;

        return $self;
    }

    public function withPicture(?string $picture): self
    {
        $self = clone $this;
        $self['picture'] = $picture;

        return $self;
    }

    public function withPreferredName(?string $preferredName): self
    {
        $self = clone $this;
        $self['preferredName'] = $preferredName;

        return $self;
    }

    public function withProfile(?string $profile): self
    {
        $self = clone $this;
        $self['profile'] = $profile;

        return $self;
    }

    /**
     * @param SlackShape|null $slack
     */
    public function withSlack(
        SendToSlackChannel|array|SendToSlackEmail|SendToSlackUserID|null $slack
    ): self {
        $self = clone $this;
        $self['slack'] = $slack;

        return $self;
    }

    public function withSub(?string $sub): self
    {
        $self = clone $this;
        $self['sub'] = $sub;

        return $self;
    }

    public function withUpdatedAt(?string $updatedAt): self
    {
        $self = clone $this;
        $self['updatedAt'] = $updatedAt;

        return $self;
    }

    public function withWebsite(?string $website): self
    {
        $self = clone $this;
        $self['website'] = $website;

        return $self;
    }

    public function withZoneinfo(?string $zoneinfo): self
    {
        $self = clone $this;
        $self['zoneinfo'] = $zoneinfo;

        return $self;
    }
}
