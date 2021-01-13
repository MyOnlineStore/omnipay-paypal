<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;

final class RestCreateWebhookRequestTest extends TestCase
{
    /**
     * @var RestCreateWebhookRequest
     */
    private $request;

    public function setUp(): void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new RestCreateWebhookRequest($client, $request);
    }

    public function testGetData(): void
    {
        $event1 = 'PAYMENT.AUTHORIZATION.CREATED';
        $event2 = 'PAYMENT.AUTHORIZATION.VOIDED';
        $url = 'https://foo.bar/baz';
        $this->request->initialize(
            [
                'event_types' => [$event1, $event2],
                'url' => $url,
            ]
        );

        self::assertEquals(
            [
                'event_types' => [['name' => $event1], ['name' => $event2]],
                'url' => $url,
            ],
            $this->request->getData()
        );
    }

    public function testGetEndpoint(): void
    {
        self::assertStringEndsWith('/notifications/webhooks', $this->request->getEndpoint());
    }

    public function testGetEventTypes(): void
    {
        $value = ['PAYMENT.AUTHORIZATION.CREATED'];
        $this->request->setEventTypes($value);
        self::assertSame($value, $this->request->getEventTypes());
    }

    public function testGetUrl(): void
    {
        $value = 'https://foo.bar/baz';
        $this->request->setUrl($value);
        self::assertSame($value, $this->request->getUrl());
    }
}
