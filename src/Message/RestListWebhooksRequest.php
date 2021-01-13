<?php

namespace Omnipay\PayPal\Message;

/**
 * PayPal REST List Webhooks request
 *
 * @link https://developer.paypal.com/docs/api/webhooks/v1/#webhooks_list
 */
final class RestListWebhooksRequest extends AbstractRestRequest
{
    public function getData(): array
    {
        return [];
    }

    public function getEndpoint(): string
    {
        return parent::getEndpoint() . '/notifications/webhooks';
    }

    protected function createResponse($data, $statusCode): RestListWebhooksResponse
    {
        return $this->response = new RestListWebhooksResponse($this, $data, $statusCode);
    }

    protected function getHttpMethod(): string
    {
        return 'GET';
    }
}
