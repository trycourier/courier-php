<?php

namespace Tests\Services\Automations;

use Courier\Client;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class InvokeTest extends TestCase
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
    public function testInvokeAdHoc(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeAdHoc([
            'automation' => ['steps' => [['action' => 'delay'], ['action' => 'send']]],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testInvokeAdHocWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeAdHoc([
            'automation' => [
                'steps' => [
                    [
                        'action' => 'delay',
                        'duration' => 'duration',
                        'until' => '20240408T080910.123',
                    ],
                    [
                        'action' => 'send',
                        'brand' => 'brand',
                        'data' => ['foo' => 'bar'],
                        'profile' => ['foo' => 'bar'],
                        'recipient' => 'recipient',
                        'template' => '64TP5HKPFTM8VTK1Y75SJDQX9JK0',
                    ],
                ],
                'cancelation_token' => 'delay-send--user-yes--abc-123',
            ],
        ]);

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testInvokeByTemplate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeByTemplate(
            'templateId',
            ['recipient' => 'recipient']
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testInvokeByTemplateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeByTemplate(
            'templateId',
            ['recipient' => 'recipient']
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
