<?php

namespace Omnipay\PayPal\Message;

use Omnipay\PayPal\Support\Webhook;

final class RestCreateWebhookResponse extends RestResponse
{
    public function getWebhook(): ?Webhook
    {
        if (!$this->isSuccessful()) {
            return null;
        }

        return new Webhook(
            $this->data['id'],
            $this->data['url'],
            \array_map(
                static function (array $eventType): string {
                    return $eventType['name'];
                },
                $this->data['event_types']
            )
        );
    }
}
