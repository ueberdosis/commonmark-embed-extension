<?php

namespace Ueberdosis\CommonMark;

use League\CommonMark\Node\Block\AbstractBlock;

class Embed extends AbstractBlock
{
    private string $url;

    private ServiceInterface $service;

    public function __construct($url, $service)
    {
        $this->setUrl($url);
        $this->setService($service);
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
    }

    public function getService(): ServiceInterface
    {
        return $this->service;
    }

    public function setService(ServiceInterface $service)
    {
        $this->service = $service;
    }
}
