<?php

namespace Tests\Services\Lists;

use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Util;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
use Courier\PreferenceStatus;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SubscriptionsTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->list('list_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionListResponse::class, $result);
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->add(
            'list_id',
            recipients: [
                ['recipientID' => 'user_abc'], ['recipientID' => 'user_def'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->add(
            'list_id',
            recipients: [
                [
                    'recipientID' => 'user_abc',
                    'preferences' => [
                        'categories' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                        'notifications' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                    ],
                ],
                [
                    'recipientID' => 'user_def',
                    'preferences' => [
                        'categories' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                        'notifications' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                    ],
                ],
            ],
            idempotencyKey: 'order-ORD-456-user-123',
            xIdempotencyExpiration: '1785312000',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSubscribe(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribe(
            'list_id',
            recipients: [
                ['recipientID' => 'user_abc'], ['recipientID' => 'user_def'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSubscribeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribe(
            'list_id',
            recipients: [
                [
                    'recipientID' => 'user_abc',
                    'preferences' => [
                        'categories' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                        'notifications' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                    ],
                ],
                [
                    'recipientID' => 'user_def',
                    'preferences' => [
                        'categories' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                        'notifications' => [
                            'foo' => [
                                'status' => PreferenceStatus::OPTED_IN,
                                'channelPreferences' => [
                                    ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                ],
                                'rules' => [['until' => 'until', 'start' => 'start']],
                            ],
                        ],
                    ],
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSubscribeUser(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribeUser(
            'user_id',
            listID: 'list_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSubscribeUserWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribeUser(
            'user_id',
            listID: 'list_id',
            preferences: [
                'categories' => [
                    'foo' => [
                        'status' => PreferenceStatus::OPTED_IN,
                        'channelPreferences' => [
                            ['channel' => ChannelClassification::DIRECT_MESSAGE],
                        ],
                        'rules' => [['until' => 'until', 'start' => 'start']],
                    ],
                ],
                'notifications' => [
                    'nt_01kx4h2jdafq8bk9aftxak4b40' => [
                        'status' => PreferenceStatus::OPTED_IN,
                        'channelPreferences' => [
                            ['channel' => ChannelClassification::DIRECT_MESSAGE],
                        ],
                        'rules' => [['until' => 'until', 'start' => 'start']],
                    ],
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnsubscribeUser(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->unsubscribeUser(
            'user_id',
            listID: 'list_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnsubscribeUserWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->lists->subscriptions->unsubscribeUser(
            'user_id',
            listID: 'list_id'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
