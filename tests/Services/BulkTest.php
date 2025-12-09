<?php

namespace Tests\Services;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\ChannelClassification;
use Courier\Client;
use Courier\PreferenceStatus;
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

        $result = $this->client->bulk->addUsers('job_id', ['users' => [[]]]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
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
                'users' => [
                    [
                        'data' => [],
                        'preferences' => [
                            'categories' => [
                                'foo' => [
                                    'status' => PreferenceStatus::OPTED_IN,
                                    'channel_preferences' => [
                                        ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                    ],
                                    'rules' => [['until' => 'until', 'start' => 'start']],
                                ],
                            ],
                            'notifications' => [
                                'foo' => [
                                    'status' => PreferenceStatus::OPTED_IN,
                                    'channel_preferences' => [
                                        ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                    ],
                                    'rules' => [['until' => 'until', 'start' => 'start']],
                                ],
                            ],
                        ],
                        'profile' => [],
                        'recipient' => 'recipient',
                        'to' => [
                            'account_id' => 'account_id',
                            'context' => ['tenant_id' => 'tenant_id'],
                            'data' => ['foo' => 'bar'],
                            'email' => 'email',
                            'list_id' => 'list_id',
                            'locale' => 'locale',
                            'phone_number' => 'phone_number',
                            'preferences' => [
                                'notifications' => [
                                    'foo' => [
                                        'status' => PreferenceStatus::OPTED_IN,
                                        'channel_preferences' => [
                                            ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                        ],
                                        'rules' => [['until' => 'until', 'start' => 'start']],
                                        'source' => 'subscription',
                                    ],
                                ],
                                'categories' => [
                                    'foo' => [
                                        'status' => PreferenceStatus::OPTED_IN,
                                        'channel_preferences' => [
                                            ['channel' => ChannelClassification::DIRECT_MESSAGE],
                                        ],
                                        'rules' => [['until' => 'until', 'start' => 'start']],
                                        'source' => 'subscription',
                                    ],
                                ],
                                'templateId' => 'templateId',
                            ],
                            'tenant_id' => 'tenant_id',
                            'user_id' => 'user_id',
                        ],
                    ],
                ],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCreateJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->createJob([
            'message' => ['template' => 'template'],
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkNewJobResponse::class, $result);
    }

    #[Test]
    public function testCreateJobWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->createJob([
            'message' => [
                'template' => 'template',
                'brand' => 'brand',
                'data' => ['foo' => 'bar'],
                'event' => 'event',
                'locale' => ['foo' => ['foo' => 'bar']],
                'override' => ['foo' => 'bar'],
            ],
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkNewJobResponse::class, $result);
    }

    #[Test]
    public function testListUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->listUsers('job_id', []);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkListUsersResponse::class, $result);
    }

    #[Test]
    public function testRetrieveJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->retrieveJob('job_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkGetJobResponse::class, $result);
    }

    #[Test]
    public function testRunJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->runJob('job_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
