<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Core\Util;
use Courier\Feedback\FeedbackNewResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class FeedbackTest extends TestCase
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

        $result = $this->client->feedback->create(
            category: 'possible_bug',
            description: 'GET /lists/{list_id}/subscriptions returned items: [] with paging.more set to true, and following the cursor returned the remaining subscribers.',
            surface: 'api',
            title: 'List subscriptions returns an empty page with a next cursor',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeedbackNewResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->feedback->create(
            category: 'possible_bug',
            description: 'GET /lists/{list_id}/subscriptions returned items: [] with paging.more set to true, and following the cursor returned the remaining subscribers.',
            surface: 'api',
            title: 'List subscriptions returns an empty page with a next cursor',
            expectedBehavior: 'Every page before the last one contains at least one item.',
            harness: 'Claude Code',
            location: 'GET /lists/{list_id}/subscriptions',
            model: 'claude-opus-5-5',
            requestID: '1-67f340b1-58b7b231d9485ef0cda0a38b',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(FeedbackNewResponse::class, $result);
    }
}
