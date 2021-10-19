<?php

namespace Ueberdosis\CommonMark\Services;

use League\CommonMark\Util\HtmlElement;
use Ueberdosis\CommonMark\Embed;
use Ueberdosis\CommonMark\ServiceInterface;

class Vimeo implements ServiceInterface
{
    public const pattern = '(http|https)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)';

    public function render(Embed $node): HtmlElement
    {
        // Output: <iframe src="https://player.vimeo.com/video/551694700" width="640" height="360" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>

        return new HtmlElement(
            'iframe',
            [
                'src' => 'https://player.vimeo.com/video/' . $this->getId($node->getUrl()),
                'width' => '640',
                'height' => '360',
                'frameborder' => '0',
                'allow' => 'autoplay; fullscreen; picture-in-picture',
                'allowfullscreen' => '',
            ],
        );
    }

    protected function getId($url)
    {
        preg_match('/'.self::pattern.'/', $url, $matches);

        return $matches[4] ?? '';
    }
}
