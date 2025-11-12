<?php

namespace Tests\Services;

use Courier\Client;
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
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
                        'profile' => [],
                        'recipient' => 'recipient',
                        'to' => [
                            'account_id' => 'account_id',
                            'context' => ['tenant_id' => 'tenant_id'],
                            'data' => ['foo' => 'bar'],
                            'email' => 'email',
                            'locale' => 'locale',
                            'phone_number' => 'phone_number',
                            'preferences' => [
                                'notifications' => [
                                    'foo' => [
                                        'status' => 'OPTED_IN',
                                        'channel_preferences' => [['channel' => 'direct_message']],
                                        'rules' => [['until' => 'until', 'start' => 'start']],
                                        'source' => 'subscription',
                                    ],
                                ],
                                'categories' => [
                                    'foo' => [
                                        'status' => 'OPTED_IN',
                                        'channel_preferences' => [['channel' => 'direct_message']],
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
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

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testListUsers(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->listUsers('job_id', []);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRetrieveJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->retrieveJob('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testRunJob(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->bulk->runJob('job_id');

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
