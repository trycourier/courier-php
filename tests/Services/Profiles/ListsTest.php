<?php

namespace Tests\Services\Profiles;

use Courier\Client;
use Courier\Profiles\Lists\ListDeleteResponse;
use Courier\Profiles\Lists\ListGetResponse;
use Courier\Profiles\Lists\ListSubscribeResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class ListsTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->profiles->lists->retrieve('user_id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ListGetResponse::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->profiles->lists->delete('user_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ListDeleteResponse::class, $result);
    }

    #[Test]
    public function testSubscribe(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->profiles->lists->subscribe(
            'user_id',
            ['lists' => [['listId' => 'listId']]]
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ListSubscribeResponse::class, $result);
    }

    #[Test]
    public function testSubscribeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->profiles->lists->subscribe(
            'user_id',
            [
                'lists' => [
                    [
                        'listId' => 'listId',
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
        $this->assertInstanceOf(ListSubscribeResponse::class, $result);
    }
}
