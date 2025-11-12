<?php

namespace Tests\Services\Profiles;

use Courier\Client;
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->profiles->lists->delete('user_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
