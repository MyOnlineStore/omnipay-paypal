<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PayPal REST Delete Webhook request
 *
 * @link https://developer.paypal.com/docs/api/webhooks/v1/#webhooks_delete
 */
final class RestDeleteWebhookRequest extends AbstractRestRequest
{
    /**
     * @inheritDoc
     *
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('webhook_id');

        return [];
    }

    public function getEndpoint(): string
    {
        return parent::getEndpoint() . '/notifications/webhooks/' . $this->getWebhookId();
    }

    protected function getHttpMethod(): string
    {
        return 'DELETE';
    }

    public function getWebhookId(): string
    {
        return $this->getParameter('webhook_id');
    }

    public function setWebhookId(string $webhookId): self
    {
        return $this->setParameter('webhook_id', $webhookId);
    }
}
