<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Exception\InvalidRequestException;

/**
 * PayPal REST Update Webhook request
 *
 * @link https://developer.paypal.com/docs/api/webhooks/v1/#webhooks_delete
 */
final class RestUpdateWebhookRequest extends AbstractRestRequest
{
    /**
     * @inheritDoc
     *
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('webhook_id');

        $data = [];

        if (null !== $url = $this->getUrl()) {
            $data[] = [
                'op' => 'replace',
                'path' => '/url',
                'value' => $url,
            ];
        }

        $eventTypes = $this->getEventTypes();
        if (!empty($eventTypes)) {
            $data[] = [
                'op' => 'replace',
                'path' => '/event_types',
                'value' => \array_map(
                    static function (string $eventType): array {
                        return ['name' => $eventType];
                    },
                    $eventTypes
                ),
            ];
        }

        return $data;
    }

    public function getEndpoint(): string
    {
        return parent::getEndpoint() . '/notifications/webhooks/' . $this->getWebhookId();
    }

    protected function getHttpMethod(): string
    {
        return 'PATCH';
    }

    /**
     * @return list<string>
     */
    public function getEventTypes(): array
    {
        return $this->getParameter('event_types') ?: [];
    }

    public function getUrl(): ?string
    {
        return $this->getParameter('webhook_url');
    }

    public function getWebhookId(): string
    {
        return $this->getParameter('webhook_id');
    }

    /**
     * @param list<string> $eventTypes
     */
    public function setEventTypes(array $eventTypes): self
    {
        return $this->setParameter('event_types', $eventTypes);
    }

    public function setUrl(string $url): self
    {
        return $this->setParameter('webhook_url', $url);
    }

    public function setWebhookId(string $webhookId): self
    {
        return $this->setParameter('webhook_id', $webhookId);
    }
}
