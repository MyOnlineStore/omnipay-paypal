<?php
declare(strict_types=1);

namespace Omnipay\PayPal\Support;

final class Webhook
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $url;

    /**
     * @var list<string>
     */
    private $eventTypes;

    /**
     * @param list<string> $eventTypes
     */
    public function __construct(string $id, string $url, array $eventTypes)
    {
        $this->id = $id;
        $this->url = $url;
        $this->eventTypes = $eventTypes;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return list<string>
     */
    public function getEventTypes(): array
    {
        return $this->eventTypes;
    }
}
