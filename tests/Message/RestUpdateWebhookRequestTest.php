<?php
declare(strict_types=1);

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;

final class RestUpdateWebhookRequestTest extends TestCase
{
    /**
     * @var RestUpdateWebhookRequest
     */
    private $request;

    public function setUp(): void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new RestUpdateWebhookRequest($client, $request);
    }

    public function testGetFullData(): void
    {
        $this->request->initialize(
            [
                'event_types' => ['foo', 'bar'],
                'url' => 'https://foo.bar/',
                'webhook_id' => 'f0oB4r',
            ]
        );

        self::assertEquals(
            [
                [
                    'op' => 'replace',
                    'path' => '/url',
                    'value' => 'https://foo.bar/',
                ],
                [
                    'op' => 'replace',
                    'path' => '/event_types',
                    'value' => [
                        ['name' => 'foo'],
                        ['name' => 'bar'],
                    ],
                ],
            ],
            $this->request->getData()
        );
    }

    public function testGetUrlData(): void
    {
        $this->request->initialize(
            [
                'url' => 'https://foo.bar/',
                'webhook_id' => 'f0oB4r',
            ]
        );

        self::assertEquals(
            [
                [
                    'op' => 'replace',
                    'path' => '/url',
                    'value' => 'https://foo.bar/',
                ],
            ],
            $this->request->getData()
        );
    }

    public function testGetEventTypesData(): void
    {
        $this->request->initialize(
            [
                'event_types' => ['foo', 'bar'],
                'webhook_id' => 'f0oB4r',
            ]
        );

        self::assertEquals(
            [
                [
                    'op' => 'replace',
                    'path' => '/event_types',
                    'value' => [
                        ['name' => 'foo'],
                        ['name' => 'bar'],
                    ],
                ],
            ],
            $this->request->getData()
        );
    }

    public function testGetEndpoint(): void
    {
        $this->request->initialize(['webhook_id' => 'f0oB4r']);

        self::assertStringEndsWith('/notifications/webhooks/f0oB4r', $this->request->getEndpoint());
    }

    public function testEventTypesAccessors(): void
    {
        $this->request->setEventTypes(['foo', 'bar']);

        self::assertSame(['foo', 'bar'], $this->request->getEventTypes());
    }

    public function testUrlAccessors(): void
    {
        $this->request->setUrl('https://foo.bar/');

        self::assertSame('https://foo.bar/', $this->request->getUrl());
    }

    public function testWebhookIdAccessors(): void
    {
        $this->request->setWebhookId('f0oB4r');

        self::assertSame('f0oB4r', $this->request->getWebhookId());
    }
}
