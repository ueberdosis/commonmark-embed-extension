<?php

namespace Ueberdosis\CommonMark\Services;

use League\CommonMark\Util\HtmlElement;
use Ueberdosis\CommonMark\Embed;
use Ueberdosis\CommonMark\ServiceInterface;

class Vimeo implements ServiceInterface
{
    public const pattern = '(http|https)?:\/\/(www\.|player\.)?vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|video\/|)(\d+)(?:|\/\?)\/?([a-z0-9]*)?';

    public function render(Embed $node): HtmlElement
    {
        // Output: <div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/551694700" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>

        $id = $this->getId($node->getUrl());
        if ($hash = $this->getHash($node->getUrl())) {
            $query = '?' . http_build_query([
                'h' => $hash,
            ]);
        }

        return new HtmlElement(
            'div',
            [
                'style' => 'padding:56.25% 0 0 0;position:relative;',
            ],
            new HtmlElement(
                'iframe',
                [
                    'src' => 'https://player.vimeo.com/video/' . $id . ($query ?? null),
                    'frameborder' => '0',
                    'allow' => 'autoplay; fullscreen; picture-in-picture',
                    'allowfullscreen' => '',
                    'style' => 'position:absolute;top:0;left:0;width:100%;height:100%;',
                ],
            )
        );
    }

    protected function getId($url)
    {
        preg_match('/'.self::pattern.'/', $url, $matches);

        return $matches[4] ?? '';
    }

    protected function getHash($url)
    {
        preg_match('/'.self::pattern.'/', $url, $matches);

        return $matches[5] ?? '';
    }
}
