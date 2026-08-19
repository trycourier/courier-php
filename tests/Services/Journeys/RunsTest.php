<?php

namespace Tests\Services\Journeys;

use Courier\Client;
use Courier\Core\Util;
use Courier\Journeys\JourneyRunListResponse;
use Courier\Journeys\JourneyRunResponse;
use Courier\Journeys\JourneyRunStepsResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class RunsTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->runs->retrieve('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyRunResponse::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->runs->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyRunListResponse::class, $result);
    }

    #[Test]
    public function testListSteps(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->journeys->runs->listSteps('x');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(JourneyRunStepsResponse::class, $result);
    }
}
