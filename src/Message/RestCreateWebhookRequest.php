<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Exception\InvalidRequestException;

final class RestCreateWebhookRequest extends AbstractRestRequest
{
    /**
     * @inheritDoc
     *
     * @throws InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('event_types', 'webhook_url');

        return [
            'event_types' => \array_map(
                static function (string $value): array {
                    return ['name' => $value];
                },
                $this->getEventTypes()
            ),
            'url' => $this->getUrl(),
        ];
    }

    public function getEndpoint(): string
    {
        return parent::getEndpoint() . '/notifications/webhooks';
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

    protected function createResponse($data, $statusCode): RestCreateWebhookResponse
    {
        return $this->response = new RestCreateWebhookResponse($this, $data, $statusCode);
    }
}
