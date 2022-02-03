<?php

namespace Courier\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;
use Http\Mock\Client;
use Courier\CourierClient;
use Courier\CourierRequestException;

/**
 * @covers Courier\CourierClient
 * @covers Courier\CourierException
 * @covers Courier\CourierRequestException
 */
class CourierClientTest extends TestCase
{
    protected function setUp(): void
    {
        HttpClientDiscovery::prependStrategy(MockClientStrategy::class);
    }

    public function test_1xx_responses_throw_exception()
    {
        $httpClient = new Client();
        $httpClient->addResponse(
            new Response(100, [], "{}")
        );

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        $this->expectException(CourierRequestException::class);
        $courier->sendNotification("event", "recipient");
    }

    public function test_3xx_responses_and_above_throw_exception()
    {
        $httpClient = new Client();
        $httpClient->addResponse(
            new Response(300, [], json_encode(["display_message" => "PLAID_ERROR"]))
        );

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        $this->expectException(CourierRequestException::class);
        $courier->sendNotification("event", "recipient");
    }

    public function test_request_exception_passes_through_courier_display_message()
    {
        $httpClient = new Client();
        $httpClient->addResponse(
            new Response(300, [], json_encode(["display_message" => "DISPLAY MESSAGE"]))
        );

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        try {
            $courier->sendNotification("event", "recipient");
        }
        catch( CourierRequestException $courierRequestException ){

            $this->assertEquals("DISPLAY MESSAGE", $courierRequestException->getMessage());

        }
    }

    public function test_request_exception_passes_through_http_status_code()
    {
        $httpClient = new Client();
        $httpClient->addResponse(
            new Response(300, [], json_encode(["display_message" => "DISPLAY MESSAGE"]))
        );

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        try {
            $courier->sendNotification("event", "recipient");
        }
        catch( CourierRequestException $courierRequestException ){

            $this->assertEquals(300, $courierRequestException->getCode());

        }
    }

    public function test_setting_http_client()
    {
        $httpClient = new Client();

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        $reflection = new \ReflectionClass($courier);

        $method = $reflection->getMethod('getHttpClient');
        $method->setAccessible(true);

        $this->assertSame($httpClient, $method->invoke($courier));
    }

    public function test_getting_http_client_creates_default_client_if_none_set()
    {
        $courier = new CourierClient(null, "auth_token");

        $reflection = new \ReflectionClass($courier);

        $method = $reflection->getMethod('getHttpClient');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($courier) instanceof Client);
    }
}
