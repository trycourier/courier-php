<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Send\MessageContext;
use Courier\Send\SendMessageParams\Message;
use Courier\Send\SendMessageParams\Message\Channel;
use Courier\Send\SendMessageParams\Message\Channel\Metadata;
use Courier\Send\SendMessageParams\Message\Channel\Metadata\Utm;
use Courier\Send\SendMessageParams\Message\Channel\Timeouts;
use Courier\Send\SendMessageParams\Message\Content;
use Courier\Send\SendMessageParams\Message\Delay;
use Courier\Send\SendMessageParams\Message\Expiry;
use Courier\Send\SendMessageParams\Message\Preferences;
use Courier\Send\SendMessageParams\Message\Provider;
use Courier\Send\SendMessageParams\Message\Routing;
use Courier\Send\SendMessageParams\Message\Timeout;
use Courier\Send\SendMessageParams\Message\To\UnionMember0;
use Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences\Category;
use Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences\Notification;
use Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences\Notification\ChannelPreference;
use Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences\Notification\Rule;
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

        $result = $this->client->send->message(
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
    public function testMessageWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->send->message(
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
                    (new Courier\Send\SendMessageParams\Message\Metadata)
                        ->withEvent('event')
                        ->withTags(['string'])
                        ->withTraceID('trace_id')
                        ->withUtm(
                            (new Courier\Send\SendMessageParams\Message\Metadata\Utm)
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
                                (new Courier\Send\SendMessageParams\Message\Provider\Metadata)
                                    ->withUtm(
                                        (new Courier\Send\SendMessageParams\Message\Provider\Metadata\Utm)
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
                            Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences::with(
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
                                                    Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences\Category\ChannelPreference::with(
                                                        channel: 'direct_message'
                                                    ),
                                                ],
                                            )
                                            ->withRules(
                                                [
                                                    Courier\Send\SendMessageParams\Message\To\UnionMember0\Preferences\Category\Rule::with(
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
