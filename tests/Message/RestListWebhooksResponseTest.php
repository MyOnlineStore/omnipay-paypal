<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;

final class RestListWebhooksResponseTest extends TestCase
{
    public function testResponse(): void
    {
        $httpResponse = $this->getMockHttpResponse('RestListWebhooksSuccess.txt');

        $response = new RestListWebhooksResponse(
            $this->getMockRequest(),
            \json_decode($httpResponse->getBody()->getContents(), true),
            $httpResponse->getStatusCode()
        );

        self::assertTrue($response->isSuccessful());

        $webhooks = $response->getWebhooks();
        self::assertCount(2, $webhooks);

        self::assertSame('40Y916089Y8324740', $webhooks[0]->getId());
        self::assertSame('https://example.com/example_webhook', $webhooks[0]->getUrl());
        self::assertSame(
            [
                'PAYMENT.AUTHORIZATION.CREATED',
                'PAYMENT.AUTHORIZATION.VOIDED',
            ],
            $webhooks[0]->getEventTypes()
        );

        self::assertSame('0EH40505U7160970P', $webhooks[1]->getId());
        self::assertSame('https://example.com/another_example_webhook', $webhooks[1]->getUrl());
        self::assertSame(
            [
                'PAYMENT.SALE.REFUNDED',
            ],
            $webhooks[1]->getEventTypes()
        );
    }
}
