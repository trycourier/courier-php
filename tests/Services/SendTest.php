<?php

namespace Tests\Services;

use Courier\ChannelPreference;
use Courier\Client;
use Courier\ElementalContentSugar;
use Courier\Preference;
use Courier\Rule;
use Courier\Send\MessageContext;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageParams\Message\Channel;
use Courier\Send\SendMessageParams\Message\Channel\Metadata;
use Courier\Send\SendMessageParams\Message\Channel\Timeouts;
use Courier\Send\SendMessageParams\Message\Delay;
use Courier\Send\SendMessageParams\Message\Expiry;
use Courier\Send\SendMessageParams\Message\Preferences;
use Courier\Send\SendMessageParams\Message\Provider;
use Courier\Send\SendMessageParams\Message\Routing;
use Courier\Send\SendMessageParams\Message\Timeout;
use Courier\Send\Utm;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;
use Courier\UserRecipient;
use Courier\Users\Preferences\PreferenceStatus;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SendTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testMessage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->send->message(new Message);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testMessageWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->send->message(
            (new Message)
                ->withBrandID('brand_id')
                ->withChannels(
                    [
                        'foo' => (new Channel)
                            ->withBrandID('brand_id')
                            ->withIf('if')
                            ->withMetadata(
                                (new Metadata)
                                    ->withUtm(
                                        (new Utm)
                                            ->withCampaign('campaign')
                                            ->withContent('content')
                                            ->withMedium('medium')
                                            ->withSource('source')
                                            ->withTerm('term'),
                                    ),
                            )
                            ->withOverride(['foo' => 'bar'])
                            ->withProviders(['string'])
                            ->withRoutingMethod('all')
                            ->withTimeouts((new Timeouts)->withChannel(0)->withProvider(0)),
                    ],
                )
                ->withContent(ElementalContentSugar::with(body: 'body', title: 'title'))
                ->withContext((new MessageContext)->withTenantID('tenant_id'))
                ->withData(['name' => 'bar'])
                ->withDelay((new Delay)->withDuration(0)->withUntil('until'))
                ->withExpiry(
                    Expiry::with(expiresIn: 'string')->withExpiresAt('expires_at')
                )
                ->withMetadata(
                    (new Message\Metadata)
                        ->withEvent('event')
                        ->withTags(['string'])
                        ->withTraceID('trace_id')
                        ->withUtm(
                            (new Utm)
                                ->withCampaign('campaign')
                                ->withContent('content')
                                ->withMedium('medium')
                                ->withSource('source')
                                ->withTerm('term'),
                        ),
                )
                ->withPreferences(
                    Preferences::with(subscriptionTopicID: 'subscription_topic_id')
                )
                ->withProviders(
                    [
                        'foo' => (new Provider)
                            ->withIf('if')
                            ->withMetadata(
                                (new Provider\Metadata)
                                    ->withUtm(
                                        (new Utm)
                                            ->withCampaign('campaign')
                                            ->withContent('content')
                                            ->withMedium('medium')
                                            ->withSource('source')
                                            ->withTerm('term'),
                                    ),
                            )
                            ->withOverride(['foo' => 'bar'])
                            ->withTimeouts(0),
                    ],
                )
                ->withRouting(Routing::with(channels: ['string'], method: 'all'))
                ->withTemplate('template_id')
                ->withTimeout(
                    (new Timeout)
                        ->withChannel(['foo' => 0])
                        ->withCriteria('no-escalation')
                        ->withEscalation(0)
                        ->withMessage(0)
                        ->withProvider(['foo' => 0]),
                )
                ->withTo(
                    (new UserRecipient)
                        ->withAccountID('account_id')
                        ->withContext((new MessageContext)->withTenantID('tenant_id'))
                        ->withData(['foo' => 'bar'])
                        ->withEmail('email')
                        ->withLocale('locale')
                        ->withPhoneNumber('phone_number')
                        ->withPreferences(
                            UserRecipient\Preferences::with(
                                notifications: [
                                    'foo' => Preference::with(status: PreferenceStatus::OPTED_IN)
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference::with(
                                                    channel: ChannelClassification::DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')])
                                        ->withSource('subscription'),
                                ],
                            )
                                ->withCategories(
                                    [
                                        'foo' => Preference::with(status: PreferenceStatus::OPTED_IN)
                                            ->withChannelPreferences(
                                                [
                                                    ChannelPreference::with(
                                                        channel: ChannelClassification::DIRECT_MESSAGE
                                                    ),
                                                ],
                                            )
                                            ->withRules([Rule::with(until: 'until')->withStart('start')])
                                            ->withSource('subscription'),
                                    ],
                                )
                                ->withTemplateID('templateId'),
                        )
                        ->withTenantID('tenant_id')
                        ->withUserID('example_user'),
                ),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
