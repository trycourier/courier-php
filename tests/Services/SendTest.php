<?php

namespace Tests\Services;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\PreferenceStatus;
use Courier\Send\SendMessageResponse;
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

        $result = $this->client->send->message(message: []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SendMessageResponse::class, $result);
    }

    #[Test]
    public function testMessageWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->send->message(
            message: [
                'brandID' => 'brand_id',
                'channels' => [
                    'foo' => [
                        'brandID' => 'brand_id',
                        'if' => 'if',
                        'metadata' => [
                            'utm' => [
                                'campaign' => 'campaign',
                                'content' => 'content',
                                'medium' => 'medium',
                                'source' => 'source',
                                'term' => 'term',
                            ],
                        ],
                        'override' => ['foo' => 'bar'],
                        'providers' => ['string'],
                        'routingMethod' => 'all',
                        'timeouts' => ['channel' => 0, 'provider' => 0],
                    ],
                ],
                'content' => ['body' => 'body', 'title' => 'title'],
                'context' => ['tenantID' => 'tenant_id'],
                'data' => ['foo' => 'bar'],
                'delay' => [
                    'duration' => 0, 'timezone' => 'timezone', 'until' => 'until',
                ],
                'expiry' => ['expiresIn' => 'string', 'expiresAt' => 'expires_at'],
                'metadata' => [
                    'event' => 'event',
                    'tags' => ['string'],
                    'traceID' => 'trace_id',
                    'utm' => [
                        'campaign' => 'campaign',
                        'content' => 'content',
                        'medium' => 'medium',
                        'source' => 'source',
                        'term' => 'term',
                    ],
                ],
                'preferences' => ['subscriptionTopicID' => 'subscription_topic_id'],
                'providers' => [
                    'foo' => [
                        'if' => 'if',
                        'metadata' => [
                            'utm' => [
                                'campaign' => 'campaign',
                                'content' => 'content',
                                'medium' => 'medium',
                                'source' => 'source',
                                'term' => 'term',
                            ],
                        ],
                        'override' => ['foo' => 'bar'],
                        'timeouts' => 0,
                    ],
                ],
                'routing' => ['channels' => ['string'], 'method' => 'all'],
                'template' => 'template_id',
                'timeout' => [
                    'channel' => ['foo' => 0],
                    'criteria' => 'no-escalation',
                    'escalation' => 0,
                    'message' => 0,
                    'provider' => ['foo' => 0],
                ],
                'to' => [
                    'accountID' => 'account_id',
                    'context' => ['tenantID' => 'tenant_id'],
                    'data' => ['foo' => 'bar'],
                    'email' => 'email',
                    'listID' => 'list_id',
                    'locale' => 'locale',
                    'phoneNumber' => 'phone_number',
                    'preferences' => [
                        'notifications' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                                'source' => 'subscription',
                            ],
                        ],
                        'categories' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                                'source' => 'subscription',
                            ],
                        ],
                        'templateID' => 'templateId',
                    ],
                    'tenantID' => 'tenant_id',
                    'userID' => 'example_user',
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SendMessageResponse::class, $result);
    }
}
