<?php

namespace Courier\Tests;

use GuzzleHttp\Psr7\Response;
use Http\Message\RequestMatcher;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase as PHPUnitTestCase;
use Psr\Http\Message\RequestInterface;
use Courier\CourierClient;

abstract class TestCase extends PHPUnitTestCase
{
    protected function getCourierClient(): CourierClient
    {
        $alwaysMatcher = new class implements RequestMatcher {
            public function matches(RequestInterface $request)
            {
                return true;
            }
        };

        $httpClient = new Client();
        $httpClient->on($alwaysMatcher, function (RequestInterface $request) {
            return new Response(200, [], json_encode([
                "method" => $request->getMethod(),
                "authorization" => $request->getHeaderLine("Authorization"),
                "content" => $request->getHeaderLine("Content-Type"),
                "scheme" => $request->getUri()->getScheme(),
                "host" => $request->getUri()->getHost(),
                "path" => $request->getUri()->getPath(),
                "params" => \json_decode($request->getBody()->getContents()),
            ]));
        });
    
        $courier = new CourierClient(null, "auth_token");
        $courier->setHttpClient($httpClient);

        return $courier;
    }
}
