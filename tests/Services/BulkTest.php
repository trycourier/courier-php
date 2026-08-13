<?php

namespace Tests\Services;

use Courier\Bulk\BulkGetJobResponse;
use Courier\Bulk\BulkListUsersResponse;
use Courier\Bulk\BulkNewJobResponse;
use Courier\ChannelClassification;
use Courier\Client;
use Courier\Core\Util;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(apiKey: 'My API Key', baseUrl: $testUrl);

        $this->client = $client;
    }

    #[Test]
    public function testAddUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->addUsers('job_id', users: [[]]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testAddUsersWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->addUsers(
            'job_id',
            users: [
                [
                    'data' => ['name' => 'Jane'],
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
                    'profile' => ['email' => 'bar'],
                    'recipient' => 'user_abc',
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
                        'userID' => 'user_id',
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
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->createJob(
            message: ['event' => 'welcome-series']
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkNewJobResponse::class, $result);
    }

    #[Test]
    public function testCreateJobWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->createJob(
            message: [
                'event' => 'welcome-series',
                'brand' => 'bnd_01kx4mrd0pfzw8wt7pn7p2fzag',
                'content' => ['body' => 'body', 'title' => 'title'],
                'data' => ['campaign' => 'bar'],
                'locale' => ['foo' => ['foo' => 'bar']],
                'override' => ['foo' => 'bar'],
                'template' => 'template',
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkNewJobResponse::class, $result);
    }

    #[Test]
    public function testListUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->listUsers('job_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkListUsersResponse::class, $result);
    }

    #[Test]
    public function testRetrieveJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->retrieveJob('job_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(BulkGetJobResponse::class, $result);
    }

    #[Test]
    public function testRunJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->bulk->runJob('job_id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
