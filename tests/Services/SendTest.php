<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Send\BaseMessage\Channel;
use Courier\Send\BaseMessage\Channel\Metadata;
use Courier\Send\BaseMessage\Channel\Timeouts;
use Courier\Send\BaseMessage\Delay;
use Courier\Send\BaseMessage\Expiry;
use Courier\Send\BaseMessage\Metadata as Metadata1;
use Courier\Send\BaseMessage\Preferences;
use Courier\Send\BaseMessage\Provider;
use Courier\Send\BaseMessage\Provider\Metadata as Metadata2;
use Courier\Send\BaseMessage\Routing;
use Courier\Send\BaseMessage\Timeout;
use Courier\Send\BaseMessageSendTo\To\UnionMember1;
use Courier\Send\BaseMessageSendTo\To\UnionMember1\Filter;
use Courier\Send\Content\ElementalContentSugar;
use Courier\Send\Message\ContentMessage;
use Courier\Send\MessageContext;
use Courier\Send\Utm;
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
            ContentMessage::with(
                content: ElementalContentSugar::with(
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
            ContentMessage::with(
                content: ElementalContentSugar::with(
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
                    Preferences::with(subscriptionTopicID: 'subscription_topic_id')
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
                    (new UnionMember1)
                        ->withData(['foo' => 'bar'])
                        ->withFilters(
                            [
                                Filter::with(
                                    operator: 'MEMBER_OF',
                                    path: 'account_id',
                                    value: 'value'
                                ),
                            ],
                        )
                        ->withListID('list_id'),
                ),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
