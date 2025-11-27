<?php

namespace Tests\Services\Lists;

use Courier\Client;
use Courier\Lists\Subscriptions\SubscriptionListResponse;
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

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->list('list_id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionListResponse::class, $result);
    }

    #[Test]
    public function testAdd(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->add(
            'list_id',
            ['recipients' => [['recipientId' => 'recipientId']]]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testAddWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->add(
            'list_id',
            [
                'recipients' => [
                    [
                        'recipientId' => 'recipientId',
                        'preferences' => [
                            'categories' => [
                                'foo' => [
                                    'status' => 'OPTED_IN',
                                    'channel_preferences' => [['channel' => 'direct_message']],
                                    'rules' => [['until' => 'until', 'start' => 'start']],
                                ],
                            ],
                            'notifications' => [
                                'foo' => [
                                    'status' => 'OPTED_IN',
                                    'channel_preferences' => [['channel' => 'direct_message']],
                                    'rules' => [['until' => 'until', 'start' => 'start']],
                                ],
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
    public function testSubscribe(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribe(
            'list_id',
            ['recipients' => [['recipientId' => 'recipientId']]]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSubscribeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribe(
            'list_id',
            [
                'recipients' => [
                    [
                        'recipientId' => 'recipientId',
                        'preferences' => [
                            'categories' => [
                                'foo' => [
                                    'status' => 'OPTED_IN',
                                    'channel_preferences' => [['channel' => 'direct_message']],
                                    'rules' => [['until' => 'until', 'start' => 'start']],
                                ],
                            ],
                            'notifications' => [
                                'foo' => [
                                    'status' => 'OPTED_IN',
                                    'channel_preferences' => [['channel' => 'direct_message']],
                                    'rules' => [['until' => 'until', 'start' => 'start']],
                                ],
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
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribeUser(
            'user_id',
            ['list_id' => 'list_id']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testSubscribeUserWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->subscribeUser(
            'user_id',
            [
                'list_id' => 'list_id',
                'preferences' => [
                    'categories' => [
                        'foo' => [
                            'status' => 'OPTED_IN',
                            'channel_preferences' => [['channel' => 'direct_message']],
                            'rules' => [['until' => 'until', 'start' => 'start']],
                        ],
                    ],
                    'notifications' => [
                        'foo' => [
                            'status' => 'OPTED_IN',
                            'channel_preferences' => [['channel' => 'direct_message']],
                            'rules' => [['until' => 'until', 'start' => 'start']],
                        ],
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
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->unsubscribeUser(
            'user_id',
            ['list_id' => 'list_id']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUnsubscribeUserWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->lists->subscriptions->unsubscribeUser(
            'user_id',
            ['list_id' => 'list_id']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
