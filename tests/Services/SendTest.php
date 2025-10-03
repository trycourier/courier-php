<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Send\MessageContext;
use Courier\Send\SendSendMessageParams\Message;
use Courier\Send\SendSendMessageParams\Message\Channel;
use Courier\Send\SendSendMessageParams\Message\Channel\Metadata;
use Courier\Send\SendSendMessageParams\Message\Channel\Metadata\Utm;
use Courier\Send\SendSendMessageParams\Message\Channel\Timeouts;
use Courier\Send\SendSendMessageParams\Message\Content;
use Courier\Send\SendSendMessageParams\Message\Delay;
use Courier\Send\SendSendMessageParams\Message\Expiry;
use Courier\Send\SendSendMessageParams\Message\Preferences;
use Courier\Send\SendSendMessageParams\Message\Provider;
use Courier\Send\SendSendMessageParams\Message\Routing;
use Courier\Send\SendSendMessageParams\Message\Timeout;
use Courier\Send\SendSendMessageParams\Message\To\UnionMember0;
use Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Category;
use Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification;
use Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification\ChannelPreference;
use Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Notification\Rule;
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
    public function testSendMessage(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->send->sendMessage(
            Message::with(
                content: Content::with(
                    body: 'Thanks for signing up, {{name}}',
                    title: 'Welcome!'
                ),
            ),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testSendMessageWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->send->sendMessage(
            Message::with(
                content: Content::with(
                    body: 'Thanks for signing up, {{name}}',
                    title: 'Welcome!'
                ),
            )
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
                ->withContext((new MessageContext)->withTenantID('tenant_id'))
                ->withData(['name' => 'bar'])
                ->withDelay((new Delay)->withDuration(0)->withUntil('until'))
                ->withExpiry(
                    Expiry::with(expiresIn: 'string')->withExpiresAt('expires_at')
                )
                ->withMetadata(
                    (new Courier\Send\SendSendMessageParams\Message\Metadata)
                        ->withEvent('event')
                        ->withTags(['string'])
                        ->withTraceID('trace_id')
                        ->withUtm(
                            (new Courier\Send\SendSendMessageParams\Message\Metadata\Utm)
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
                                (new Courier\Send\SendSendMessageParams\Message\Provider\Metadata)
                                    ->withUtm(
                                        (new Courier\Send\SendSendMessageParams\Message\Provider\Metadata\Utm)
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
                ->withRouting(Routing::with(channels: ['email'], method: 'single'))
                ->withTimeout(
                    (new Timeout)
                        ->withChannel(['foo' => 0])
                        ->withCriteria('no-escalation')
                        ->withEscalation(0)
                        ->withMessage(0)
                        ->withProvider(['foo' => 0]),
                )
                ->withTo(
                    (new UnionMember0)
                        ->withAccountID('account_id')
                        ->withContext((new MessageContext)->withTenantID('tenant_id'))
                        ->withData(['foo' => 'bar'])
                        ->withEmail('email@example.com')
                        ->withLocale('locale')
                        ->withPhoneNumber('phone_number')
                        ->withPreferences(
                            Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences::with(
                                notifications: [
                                    'foo' => Notification::with(status: 'OPTED_IN')
                                        ->withChannelPreferences(
                                            [ChannelPreference::with(channel: 'direct_message')]
                                        )
                                        ->withRules([Rule::with(until: 'until')->withStart('start')])
                                        ->withSource('subscription'),
                                ],
                            )
                                ->withCategories(
                                    [
                                        'foo' => Category::with(status: 'OPTED_IN')
                                            ->withChannelPreferences(
                                                [
                                                    Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Category\ChannelPreference::with(
                                                        channel: 'direct_message'
                                                    ),
                                                ],
                                            )
                                            ->withRules(
                                                [
                                                    Courier\Send\SendSendMessageParams\Message\To\UnionMember0\Preferences\Category\Rule::with(
                                                        until: 'until'
                                                    )
                                                        ->withStart('start'),
                                                ],
                                            )
                                            ->withSource('subscription'),
                                    ],
                                )
                                ->withTemplateID('templateId'),
                        )
                        ->withTenantID('tenant_id')
                        ->withUserID('user_id'),
                ),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
