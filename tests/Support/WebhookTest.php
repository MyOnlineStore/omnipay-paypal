<?php
declare(strict_types=1);

namespace Omnipay\PayPal\Support;

use Omnipay\PayPal\Support\Webhook;
use PHPUnit\Framework\TestCase;

final class WebhookTest extends TestCase
{
    public function testAccessors(): void
    {
        $webhook = new Webhook('f0oB4r', 'https://foo.bar/', ['foo', 'bar']);

        self::assertSame('f0oB4r', $webhook->getId());
        self::assertSame('https://foo.bar/', $webhook->getUrl());
        self::assertSame(['foo', 'bar'], $webhook->getEventTypes());
    }
}
