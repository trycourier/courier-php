<?php

namespace Tests\Services;

use Courier\Bulk\InboundBulkMessage;
use Courier\Bulk\InboundBulkMessage\Message\InboundBulkTemplateMessage;
use Courier\Bulk\InboundBulkMessageUser;
use Courier\Bulk\UserRecipient;
use Courier\Bulk\UserRecipient\Preferences;
use Courier\Bulk\UserRecipient\Preferences\Category as Category1;
use Courier\Bulk\UserRecipient\Preferences\Category\ChannelPreference as ChannelPreference3;
use Courier\Bulk\UserRecipient\Preferences\Category\Rule as Rule3;
use Courier\Bulk\UserRecipient\Preferences\Notification as Notification1;
use Courier\Bulk\UserRecipient\Preferences\Notification\ChannelPreference as ChannelPreference2;
use Courier\Bulk\UserRecipient\Preferences\Notification\Rule as Rule2;
use Courier\Client;
use Courier\Lists\Subscriptions\RecipientPreferences;
use Courier\Lists\Subscriptions\RecipientPreferences\Category;
use Courier\Lists\Subscriptions\RecipientPreferences\Category\ChannelPreference;
use Courier\Lists\Subscriptions\RecipientPreferences\Category\Rule;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification\ChannelPreference as ChannelPreference1;
use Courier\Lists\Subscriptions\RecipientPreferences\Notification\Rule as Rule1;
use Courier\Send\BaseMessage\Channel;
use Courier\Send\BaseMessage\Channel\Metadata;
use Courier\Send\BaseMessage\Channel\Timeouts;
use Courier\Send\BaseMessage\Delay;
use Courier\Send\BaseMessage\Expiry;
use Courier\Send\BaseMessage\Metadata as Metadata1;
use Courier\Send\BaseMessage\Preferences as Preferences1;
use Courier\Send\BaseMessage\Provider;
use Courier\Send\BaseMessage\Provider\Metadata as Metadata2;
use Courier\Send\BaseMessage\Routing;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyChannel;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyChannel\Provider as Provider1;
use Courier\Send\BaseMessage\Routing\Channel\RoutingStrategyChannel\Provider\Metadata as Metadata3;
use Courier\Send\BaseMessage\Timeout;
use Courier\Send\MessageContext;
use Courier\Send\RoutingMethod;
use Courier\Send\Utm;
use Courier\Tenants\DefaultPreferences\Items\ChannelClassification;
use Courier\Users\Preferences\PreferenceStatus;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class BulkTest extends TestCase
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
    public function testAddUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->addUsers(
            'job_id',
            [new InboundBulkMessageUser]
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testAddUsersWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->addUsers(
            'job_id',
            [
                (new InboundBulkMessageUser)
                    ->withData((object) [])
                    ->withPreferences(
                        (new RecipientPreferences)
                            ->withCategories(
                                [
                                    'foo' => Category::with(status: PreferenceStatus::$OPTED_IN)
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference::with(
                                                    channel: ChannelClassification::$DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')]),
                                ],
                            )
                            ->withNotifications(
                                [
                                    'foo' => Notification::with(status: PreferenceStatus::$OPTED_IN)
                                        ->withChannelPreferences(
                                            [
                                                ChannelPreference1::with(
                                                    channel: ChannelClassification::$DIRECT_MESSAGE
                                                ),
                                            ],
                                        )
                                        ->withRules([Rule1::with(until: 'until')->withStart('start')]),
                                ],
                            ),
                    )
                    ->withProfile((object) [])
                    ->withRecipient('recipient')
                    ->withTo(
                        (new UserRecipient)
                            ->withAccountID('account_id')
                            ->withContext((new MessageContext)->withTenantID('tenant_id'))
                            ->withData(['foo' => 'bar'])
                            ->withEmail('email')
                            ->withLocale('locale')
                            ->withPhoneNumber('phone_number')
                            ->withPreferences(
                                Preferences::with(
                                    notifications: [
                                        'foo' => Notification1::with(
                                            status: PreferenceStatus::$OPTED_IN
                                        )
                                            ->withChannelPreferences(
                                                [
                                                    ChannelPreference2::with(
                                                        channel: ChannelClassification::$DIRECT_MESSAGE
                                                    ),
                                                ],
                                            )
                                            ->withRules([Rule2::with(until: 'until')->withStart('start')])
                                            ->withSource('subscription'),
                                    ],
                                )
                                    ->withCategories(
                                        [
                                            'foo' => Category1::with(status: PreferenceStatus::$OPTED_IN)
                                                ->withChannelPreferences(
                                                    [
                                                        ChannelPreference3::with(
                                                            channel: ChannelClassification::$DIRECT_MESSAGE
                                                        ),
                                                    ],
                                                )
                                                ->withRules([Rule3::with(until: 'until')->withStart('start')])
                                                ->withSource('subscription'),
                                        ],
                                    )
                                    ->withTemplateID('templateId'),
                            )
                            ->withTenantID('tenant_id')
                            ->withUserID('user_id'),
                    ),
            ],
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->createJob(new InboundBulkMessage);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testCreateJobWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->createJob(
            (new InboundBulkMessage)
                ->withBrand('brand')
                ->withData(['foo' => 'bar'])
                ->withEvent('event')
                ->withLocale(['foo' => 'bar'])
                ->withMessage(
                    InboundBulkTemplateMessage::with(template: 'template')
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
                                    ->withRoutingMethod(RoutingMethod::$ALL)
                                    ->withTimeouts((new Timeouts)->withChannel(0)->withProvider(0)),
                            ],
                        )
                        ->withContext((new MessageContext)->withTenantID('tenant_id'))
                        ->withData(['foo' => 'bar'])
                        ->withDelay((new Delay)->withDuration(0)->withUntil('until'))
                        ->withExpiry(
                            Expiry::with(expiresIn: 'string')->withExpiresAt('expires_at')
                        )
                        ->withMetadata(
                            (new Metadata1)
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
                            Preferences1::with(subscriptionTopicID: 'subscription_topic_id')
                        )
                        ->withProviders(
                            [
                                'foo' => (new Provider)
                                    ->withIf('if')
                                    ->withMetadata(
                                        (new Metadata2)
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
                        ->withRouting(
                            Routing::with(
                                channels: [
                                    RoutingStrategyChannel::with(channel: 'channel')
                                        ->withConfig(['foo' => 'bar'])
                                        ->withIf('if')
                                        ->withMethod(RoutingMethod::$ALL)
                                        ->withProviders(
                                            [
                                                'foo' => (new Provider1)
                                                    ->withIf('if')
                                                    ->withMetadata(
                                                        (new Metadata3)
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
                                        ),
                                ],
                                method: RoutingMethod::$ALL,
                            ),
                        )
                        ->withTimeout(
                            (new Timeout)
                                ->withChannel(['foo' => 0])
                                ->withCriteria('no-escalation')
                                ->withEscalation(0)
                                ->withMessage(0)
                                ->withProvider(['foo' => 0]),
                        ),
                )
                ->withOverride((object) []),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testListUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->listUsers('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieveJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->retrieveJob('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRunJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->runJob('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
