<?php

namespace Courier\Tests;

use Capsule\Request;
use Capsule\Response;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Shuttle\Handler\MockHandler;
use Shuttle\Shuttle;
use Courier\CourierClient;


abstract class TestCase extends PHPUnitTestCase
{
    protected function getCourierClient(): CourierClient
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

                    return new Response(200, \json_encode($requestParams));

                }
            ])
        ]);
    
        $Courier = new CourierClient(null, "auth_token");
        $Courier->setHttpClient($httpClient);

        return $Courier;
    }
}
