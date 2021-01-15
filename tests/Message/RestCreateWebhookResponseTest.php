<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;

final class RestCreateWebhookResponseTest extends TestCase
{
    public function testResponse(): void
    {
        $httpResponse = $this->getMockHttpResponse('RestCreateWebhookSuccess.txt');

        $response = new RestCreateWebhookResponse(
            $this->getMockRequest(),
            \json_decode($httpResponse->getBody()->getContents(), true),
            $httpResponse->getStatusCode()
        );

        self::assertTrue($response->isSuccessful());

        $webhook = $response->getWebhook();

        self::assertNotNull($webhook);
        self::assertSame('0EH40505U7160970P', $webhook->getId());
        self::assertSame('https://example.com/example_webhook', $webhook->getUrl());
        self::assertSame(
            [
                'PAYMENT.AUTHORIZATION.CREATED',
                'PAYMENT.AUTHORIZATION.VOIDED',
            ],
            $webhook->getEventTypes()
        );
    }
}
