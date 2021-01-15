<?php

namespace Omnipay\PayPal\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;
use Omnipay\PayPal\Support\Webhook;

final class RestListWebhooksResponse extends RestResponse
{
    /**
     * @return list<Webhook>
     */
    public function getWebhooks(): array
    {
        if (!isset($this->data['webhooks'])) {
            return [];
        }

        return \array_map(
            static function (array $webhook): Webhook {
                return new Webhook(
                    $webhook['id'],
                    $webhook['url'],
                    \array_map(
                        static function (array $eventType): string {
                            return $eventType['name'];
                        },
                        $webhook['event_types']
                    )
                );
            },
            $this->data['webhooks']
        );
    }
}
