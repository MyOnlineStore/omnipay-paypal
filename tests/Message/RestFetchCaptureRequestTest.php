<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Tests\TestCase;

class RestFetchCaptureRequestTest extends TestCase
{
    /** @var \Omnipay\PayPal\Message\RestFetchCaptureRequest */
    private $request;

    public function setUp()
    {
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new RestFetchCaptureRequest($client, $request);
    }

    public function testEndpoint()
    {
        $this->request->setTransactionReference('ABC-123');
        $this->assertStringEndsWith('/payments/captures/ABC-123', $this->request->getEndpoint());
    }
}
