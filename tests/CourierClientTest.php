<?php

namespace Courier\Tests;

use Capsule\Request;
use Capsule\Response;
use Shuttle\Handler\MockHandler;
use Shuttle\Shuttle;
use Courier\CourierClient;
use Courier\CourierException;
use Courier\CourierRequestException;

/**
 * @covers Courier\CourierClient
 * @covers Courier\CourierException
 * @covers Courier\CourierRequestException
 */
class CourierClientTest extends TestCase
{
    public function test_1xx_responses_throw_exception()
    {
        $httpClient = new Shuttle([
            'handler' => new MockHandler([
                function(Request $request) {

                    $requestParams = [
                        "method" => $request->getMethod(),
                        "authorization" => $request->getHeaderLine("Authorization"),
                        "content" => $request->getHeaderLine("Content-Type"),
                        "scheme" => $request->getUri()->getScheme(),
                        "host" => $request->getUri()->getHost(),
                        "path" => $request->getUri()->getPath(),
                        "params" => \json_decode($request->getBody()->getContents()),
                    ];

                    return new Response(100, \json_encode($requestParams));

                }
            ])
        ]);

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        $this->expectException(CourierRequestException::class);
        $courier->sendNotification("event", "recipient");
    }

    public function test_3xx_responses_and_above_throw_exception()
    {
        $httpClient = new Shuttle([
            'handler' => new MockHandler([
                function(Request $request) {

                    $requestParams = [
                        "display_message" => "PLAID_ERROR",
                    ];

                    return new Response(300, \json_encode($requestParams));

                }
            ])
        ]);

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        $this->expectException(CourierRequestException::class);
        $courier->sendNotification("event", "recipient");
    }

    public function test_request_exception_passes_through_courier_display_message()
    {
        $httpClient = new Shuttle([
            'handler' => new MockHandler([
                function(Request $request) {

                    $requestParams = [
                        "display_message" => "DISPLAY MESSAGE",
                    ];

                    return new Response(300, \json_encode($requestParams));

                }
            ])
        ]);

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
        $httpClient = new Shuttle([
            'handler' => new MockHandler([
                function(Request $request) {

                    $requestParams = [
                        "display_message" => "DISPLAY MESSAGE",
                    ];

                    return new Response(300, \json_encode($requestParams));

                }
            ])
        ]);

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
        $httpClient = new Shuttle;

        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        $reflection = new \ReflectionClass($courier);

        $method = $reflection->getMethod('getHttpClient');
        $method->setAccessible(true);

        $this->assertSame($httpClient, $method->invoke($courier));
    }

    public function test_getting_http_client_creates_default_client_if_none_set()
    {
        $httpClient = new Shuttle;

        $courier = new CourierClient(null, "auth_token");

        $reflection = new \ReflectionClass($courier);

        $method = $reflection->getMethod('getHttpClient');
        $method->setAccessible(true);

        $this->assertTrue($method->invoke($courier) instanceof Shuttle);
    }
}
