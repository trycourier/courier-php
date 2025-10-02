<?php

namespace Courier\Profiles\Types;

use Courier\Core\Json\JsonSerializableType;
use Courier\Core\Json\JsonProperty;
use Courier\Core\Types\Union;

class UserProfile extends JsonSerializableType
{
    /**
     * @var Address $address
     */
    #[JsonProperty('address')]
    public Address $address;

    /**
     * @var string $birthdate
     */
    #[JsonProperty('birthdate')]
    public string $birthdate;

    /**
     * @var string $email
     */
    #[JsonProperty('email')]
    public string $email;

    /**
     * @var bool $emailVerified
     */
    #[JsonProperty('email_verified')]
    public bool $emailVerified;

    /**
     * @var string $familyName
     */
    #[JsonProperty('family_name')]
    public string $familyName;

    /**
     * @var string $gender
     */
    #[JsonProperty('gender')]
    public string $gender;

    /**
     * @var string $givenName
     */
    #[JsonProperty('given_name')]
    public string $givenName;

    /**
     * @var string $locale
     */
    #[JsonProperty('locale')]
    public string $locale;

    /**
     * @var string $middleName
     */
    #[JsonProperty('middle_name')]
    public string $middleName;

    /**
     * @var string $name
     */
    #[JsonProperty('name')]
    public string $name;

    /**
     * @var string $nickname
     */
    #[JsonProperty('nickname')]
    public string $nickname;

    /**
     * @var string $phoneNumber
     */
    #[JsonProperty('phone_number')]
    public string $phoneNumber;

    /**
     * @var bool $phoneNumberVerified
     */
    #[JsonProperty('phone_number_verified')]
    public bool $phoneNumberVerified;

    /**
     * @var string $picture
     */
    #[JsonProperty('picture')]
    public string $picture;

    /**
     * @var string $preferredName
     */
    #[JsonProperty('preferred_name')]
    public string $preferredName;

    /**
     * @var string $profile
     */
    #[JsonProperty('profile')]
    public string $profile;

    /**
     * @var string $sub
     */
    #[JsonProperty('sub')]
    public string $sub;

    /**
     * @var string $updatedAt
     */
    #[JsonProperty('updated_at')]
    public string $updatedAt;

    /**
     * @var string $website
     */
    #[JsonProperty('website')]
    public string $website;

    /**
     * @var string $zoneinfo
     */
    #[JsonProperty('zoneinfo')]
    public string $zoneinfo;

    /**
     * @var mixed $custom A free form object. Due to a limitation of the API Explorer, you can only enter string key/values below, but this API accepts more complex object structures.
     */
    #[JsonProperty('custom')]
    public mixed $custom;

    /**
     * @var AirshipProfile $airship
     */
    #[JsonProperty('airship')]
    public AirshipProfile $airship;

    /**
     * @var string $apn
     */
    #[JsonProperty('apn')]
    public string $apn;

    /**
     * @var string $targetArn
     */
    #[JsonProperty('target_arn')]
    public string $targetArn;

    /**
     * @var (
     *    SendToChannel
     *   |SendDirectMessage
     * ) $discord
     */
    #[JsonProperty('discord'), Union(SendToChannel::class, SendDirectMessage::class)]
    public SendToChannel|SendDirectMessage $discord;

    /**
     * @var (
     *    Token
     *   |MultipleTokens
     * ) $expo
     */
    #[JsonProperty('expo'), Union(Token::class, MultipleTokens::class)]
    public Token|MultipleTokens $expo;

    /**
     * @var string $facebookPsid
     */
    #[JsonProperty('facebookPSID')]
    public string $facebookPsid;

    /**
     * @var (
     *    string
     *   |array<string>
     * ) $firebaseToken
     */
    #[JsonProperty('firebaseToken'), Union('string', ['string'])]
    public string|array $firebaseToken;

    /**
     * @var Intercom $intercom
     */
    #[JsonProperty('intercom')]
    public Intercom $intercom;

    /**
     * @var (
     *    SendToSlackChannel
     *   |SendToSlackEmail
     *   |SendToSlackUserId
     * ) $slack
     */
    #[JsonProperty('slack'), Union(SendToSlackChannel::class, SendToSlackEmail::class, SendToSlackUserId::class)]
    public SendToSlackChannel|SendToSlackEmail|SendToSlackUserId $slack;

    /**
     * @var (
     *    SendToMsTeamsUserId
     *   |SendToMsTeamsEmail
     *   |SendToMsTeamsChannelId
     *   |SendToMsTeamsConversationId
     *   |SendToMsTeamsChannelName
     * ) $msTeams
     */
    #[JsonProperty('ms_teams'), Union(SendToMsTeamsUserId::class, SendToMsTeamsEmail::class, SendToMsTeamsChannelId::class, SendToMsTeamsConversationId::class, SendToMsTeamsChannelName::class)]
    public SendToMsTeamsUserId|SendToMsTeamsEmail|SendToMsTeamsChannelId|SendToMsTeamsConversationId|SendToMsTeamsChannelName $msTeams;

    /**
     * @param array{
     *   address: Address,
     *   birthdate: string,
     *   email: string,
     *   emailVerified: bool,
     *   familyName: string,
     *   gender: string,
     *   givenName: string,
     *   locale: string,
     *   middleName: string,
     *   name: string,
     *   nickname: string,
     *   phoneNumber: string,
     *   phoneNumberVerified: bool,
     *   picture: string,
     *   preferredName: string,
     *   profile: string,
     *   sub: string,
     *   updatedAt: string,
     *   website: string,
     *   zoneinfo: string,
     *   custom: mixed,
     *   airship: AirshipProfile,
     *   apn: string,
     *   targetArn: string,
     *   discord: (
     *    SendToChannel
     *   |SendDirectMessage
     * ),
     *   expo: (
     *    Token
     *   |MultipleTokens
     * ),
     *   facebookPsid: string,
     *   firebaseToken: (
     *    string
     *   |array<string>
     * ),
     *   intercom: Intercom,
     *   slack: (
     *    SendToSlackChannel
     *   |SendToSlackEmail
     *   |SendToSlackUserId
     * ),
     *   msTeams: (
     *    SendToMsTeamsUserId
     *   |SendToMsTeamsEmail
     *   |SendToMsTeamsChannelId
     *   |SendToMsTeamsConversationId
     *   |SendToMsTeamsChannelName
     * ),
     * } $values
     */
    public function __construct(
        array $values,
    ) {
        $this->address = $values['address'];
        $this->birthdate = $values['birthdate'];
        $this->email = $values['email'];
        $this->emailVerified = $values['emailVerified'];
        $this->familyName = $values['familyName'];
        $this->gender = $values['gender'];
        $this->givenName = $values['givenName'];
        $this->locale = $values['locale'];
        $this->middleName = $values['middleName'];
        $this->name = $values['name'];
        $this->nickname = $values['nickname'];
        $this->phoneNumber = $values['phoneNumber'];
        $this->phoneNumberVerified = $values['phoneNumberVerified'];
        $this->picture = $values['picture'];
        $this->preferredName = $values['preferredName'];
        $this->profile = $values['profile'];
        $this->sub = $values['sub'];
        $this->updatedAt = $values['updatedAt'];
        $this->website = $values['website'];
        $this->zoneinfo = $values['zoneinfo'];
        $this->custom = $values['custom'];
        $this->airship = $values['airship'];
        $this->apn = $values['apn'];
        $this->targetArn = $values['targetArn'];
        $this->discord = $values['discord'];
        $this->expo = $values['expo'];
        $this->facebookPsid = $values['facebookPsid'];
        $this->firebaseToken = $values['firebaseToken'];
        $this->intercom = $values['intercom'];
        $this->slack = $values['slack'];
        $this->msTeams = $values['msTeams'];
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }
}
