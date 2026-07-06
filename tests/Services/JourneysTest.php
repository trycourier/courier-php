<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Core\Util;
use Courier\Journeys\JourneyResponse;
use Courier\Journeys\JourneysInvokeResponse;
use Courier\Journeys\JourneysListResponse;
use Courier\Journeys\JourneyState;
use Courier\Journeys\JourneyVersionsListResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class JourneysTest extends TestCase
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

        $result = $this->client->journeys->create(
            name: 'Welcome Journey',
            nodes: [
                ['triggerType' => 'api-invoke', 'type' => 'trigger'],
                ['triggerType' => 'api-invoke', 'type' => 'trigger'],
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyResponse::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->create(
            name: 'Welcome Journey',
            nodes: [
                [
                    'triggerType' => 'api-invoke',
                    'type' => 'trigger',
                    'id' => 'trigger-1',
                    'conditions' => ['string', 'string'],
                    'schema' => ['foo' => 'bar'],
                ],
                [
                    'triggerType' => 'api-invoke',
                    'type' => 'trigger',
                    'id' => 'send-1',
                    'conditions' => ['string', 'string'],
                    'schema' => ['foo' => 'bar'],
                ],
            ],
            enabled: true,
            state: JourneyState::DRAFT,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyResponse::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->retrieve('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneysListResponse::class, $result);
    }

    #[Test]
    public function testArchive(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->archive('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testCancel(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->cancel(
            cancelationToken: 'x',
            runID: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testCancelWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->cancel(
            cancelationToken: 'x',
            runID: 'x'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNotNull($result);
    }

    #[Test]
    public function testInvoke(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->invoke('templateId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneysInvokeResponse::class, $result);
    }

    #[Test]
    public function testListVersions(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->listVersions('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyVersionsListResponse::class, $result);
    }

    #[Test]
    public function testPublish(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->publish('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyResponse::class, $result);
    }

    #[Test]
    public function testReplace(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->replace(
            'x',
            name: 'Welcome Journey v2',
            nodes: [['triggerType' => 'api-invoke', 'type' => 'trigger']],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyResponse::class, $result);
    }

    #[Test]
    public function testReplaceWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->replace(
            'x',
            name: 'Welcome Journey v2',
            nodes: [
                [
                    'triggerType' => 'api-invoke',
                    'type' => 'trigger',
                    'id' => 'x',
                    'conditions' => ['string', 'string'],
                    'schema' => ['foo' => 'bar'],
                ],
            ],
            enabled: true,
            state: JourneyState::DRAFT,
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyResponse::class, $result);
    }
}
