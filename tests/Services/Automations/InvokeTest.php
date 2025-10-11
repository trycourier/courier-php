<?php

namespace Tests\Services\Automations;

use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationDelayStep;
use Courier\Automations\Invoke\InvokeInvokeAdHocParams\Automation\Step\AutomationSendStep;
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

        $result = $this->client->automations->invoke->invokeAdHoc(
            automation: Automation::with(
                steps: [
                    AutomationDelayStep::with(action: 'delay'),
                    AutomationSendStep::with(action: 'send'),
                ],
            ),
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }

    #[Test]
    public function testInvokeAdHocWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->automations->invoke->invokeAdHoc(
            automation: Automation::with(
                steps: [
                    AutomationDelayStep::with(action: 'delay')
                        ->withDuration('duration')
                        ->withUntil('20240408T080910.123'),
                    AutomationSendStep::with(action: 'send')
                        ->withBrand('brand')
                        ->withData(['foo' => 'bar'])
                        ->withProfile(['foo' => 'bar'])
                        ->withRecipient('recipient')
                        ->withTemplate('64TP5HKPFTM8VTK1Y75SJDQX9JK0'),
                ],
            )
                ->withCancelationToken('delay-send--user-yes--abc-123'),
        );

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
            recipient: 'recipient'
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
            recipient: 'recipient'
        );

        $this->assertTrue(true); // @phpstan-ignore method.alreadyNarrowedType
    }
}
