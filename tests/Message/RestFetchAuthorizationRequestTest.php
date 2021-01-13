<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Tests\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

final class RestFetchAuthorizationRequestTest extends TestCase
{
    /**
     * @var ClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $httpClient;

    /**
     * @var RestFetchAuthorizationRequest
     */
    private $request;

    public function setUp()
    {
        $this->httpClient = $this->createMock(ClientInterface::class);
        $this->request = new RestFetchAuthorizationRequest($this->httpClient, $this->getHttpRequest());
    }

    public function testGetDataReturnsEmptyArray()
    {
        $this->request->initialize(['transactionReference' => 'foo']);
        self::assertEmpty($this->request->getData());
    }

    public function testGetDataThrowsExceptionWhenMissingTransactionReference()
    {
        $this->expectException(InvalidRequestException::class);
        $this->request->initialize([]);
        $this->request->getData();
    }

    public function testWillUseCorrectEndpoint()
    {
        $this->request->initialize(['transactionReference' => 'foobar']);
        $this->assertStringEndsWith('/payments/authorization/foobar', $this->request->getEndpoint());
    }

    public function testWillUseGetAsRequestMethod()
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('getContents')->willReturn(\json_encode([]));

        $response = $this->createMock(ResponseInterface::class);
        $response->method('getBody')->willReturn($stream);

        $this->httpClient->expects(self::once())
            ->method('request')
            ->with('GET', self::isType('string'), self::isType('array'), null)
            ->willReturn($response);

        $this->request->initialize(['transactionReference' => 'foobar']);
        $this->request->sendData([]);
    }
}
