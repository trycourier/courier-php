<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Core\Util;
use Courier\RoutingStrategies\AssociatedNotificationListResponse;
use Courier\RoutingStrategies\RoutingStrategyGetResponse;
use Courier\RoutingStrategies\RoutingStrategyListResponse;
use Courier\RoutingStrategies\RoutingStrategyMutationResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class RoutingStrategiesTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->create(
            name: 'Email via SendGrid',
            routing: ['channels' => ['email'], 'method' => 'single'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingStrategyMutationResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->create(
            name: 'Email via SendGrid',
            routing: ['channels' => ['email'], 'method' => 'single'],
            channels: [
                'email' => [
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
                    'providers' => ['sendgrid', 'ses'],
                    'routingMethod' => 'all',
                    'timeouts' => ['channel' => 0, 'provider' => 0],
                ],
            ],
            description: 'Routes email through sendgrid with SES failover',
            providers: [
                'sendgrid' => [
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
                    'override' => [],
                    'timeouts' => 0,
                ],
            ],
            tags: ['production', 'email'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingStrategyMutationResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->retrieve('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingStrategyGetResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingStrategyListResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->archive('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testListNotifications(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->listNotifications('id');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(AssociatedNotificationListResponse::class, $result);
    }

    #[Test]
    public function testReplace(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->replace(
            'id',
            name: 'Email via SendGrid v2',
            routing: ['channels' => ['email'], 'method' => 'single'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingStrategyMutationResponse::class, $result);
    }

    #[Test]
    public function testReplaceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->routingStrategies->replace(
            'id',
            name: 'Email via SendGrid v2',
            routing: ['channels' => ['email'], 'method' => 'single'],
            channels: [
                'email' => [
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
                    'providers' => ['ses', 'sendgrid'],
                    'routingMethod' => 'all',
                    'timeouts' => ['channel' => 0, 'provider' => 0],
                ],
            ],
            description: 'Updated routing with SES primary',
            providers: [
                'ses' => [
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
                    'override' => [],
                    'timeouts' => 0,
                ],
            ],
            tags: ['production', 'email', 'v2'],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(RoutingStrategyMutationResponse::class, $result);
    }
}
