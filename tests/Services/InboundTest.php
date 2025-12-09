<?php

namespace Tests\Services;

use Courier\Client;
use Courier\Inbound\InboundTrackEventResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class InboundTest extends TestCase
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
    public function testTrackEvent(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->inbound->trackEvent([
            'event' => 'New Order Placed',
            'messageID' => '4c62c457-b329-4bea-9bfc-17bba86c393f',
            'properties' => [
                'order_id' => 'bar', 'total_orders' => 'bar', 'last_order_id' => 'bar',
            ],
            'type' => 'track',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundTrackEventResponse::class, $result);
    }

    #[Test]
    public function testTrackEventWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->inbound->trackEvent([
            'event' => 'New Order Placed',
            'messageID' => '4c62c457-b329-4bea-9bfc-17bba86c393f',
            'properties' => [
                'order_id' => 'bar', 'total_orders' => 'bar', 'last_order_id' => 'bar',
            ],
            'type' => 'track',
            'userID' => '1234',
        ]);

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(InboundTrackEventResponse::class, $result);
    }
}
