<?php
declare(strict_types=1);

namespace Omnipay\PayPal\Message;

use Omnipay\PayPal\Message\RestDeleteWebhookRequest;
use Omnipay\Tests\TestCase;

final class RestDeleteWebhookRequestTest extends TestCase
{
    /**
     * @var RestDeleteWebhookRequest
     */
    private $request;

    public function setUp(): void
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new RestDeleteWebhookRequest($client, $request);
    }

    public function testGetFullData(): void
    {
        $this->request->initialize(['webhook_id' => 'f0oB4r']);

        self::assertEquals([], $this->request->getData());
    }

    public function testGetEndpoint(): void
    {
        $this->request->initialize(['webhook_id' => 'f0oB4r']);

        self::assertStringEndsWith('/notifications/webhooks/f0oB4r', $this->request->getEndpoint());
    }

    public function testWebhookIdAccessors(): void
    {
        $this->request->setWebhookId('f0oB4r');

        self::assertSame('f0oB4r', $this->request->getWebhookId());
    }
}
