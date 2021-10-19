<?php

namespace Ueberdosis\CommonMark\Services;

use League\CommonMark\Util\HtmlElement;
use Ueberdosis\CommonMark\Embed;
use Ueberdosis\CommonMark\ServiceInterface;

class YouTube implements ServiceInterface
{
    public const pattern = '(?:.+?)?(?:\/v\/|watch\/|\?v=|\&v=|youtu\.be\/|\/v=|^youtu\.be\/|watch\%3Fv\%3D)([a-zA-Z0-9_-]{11})+?';

    public function render(Embed $node): HtmlElement
    {
        // Output: <iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/eX2qFMC8cFo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

        return new HtmlElement(
            'iframe',
            [
                'width' => '560',
                'height' => '315',
                'src' => 'https://www.youtube-nocookie.com/embed/' . $this->getId($node->getUrl()),
                'title' => 'YouTube video player',
                'frameborder' => '0',
                'allow' => 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture',
                'allowfullscreen' => '',
            ],
        );
    }

    protected function getId($url)
    {
        preg_match('/'.self::pattern.'/', $url, $matches);

        return $matches[1] ?? '';
    }
}
