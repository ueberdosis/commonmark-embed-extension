<?php

namespace Ueberdosis\CommonMark\Tests\Services;

use League\CommonMark\Node\Node;
use League\CommonMark\Util\HtmlElement;
use Ueberdosis\CommonMark\Embed;
use Ueberdosis\CommonMark\ServiceInterface;

class TiptapEmbed implements ServiceInterface
{
    /**
    * A RegEx pattern that should match the embed URL
    */
    public const pattern = 'https:\/\/embed\.tiptap\.dev\/preview\/[A-Za-z\/?&]*';

    /**
    * @param Embed $node
    */
    public function render(Node $node): HtmlElement
    {
        Embed::assertInstanceOf($node);

        return new HtmlElement(
            'tiptap-demo',
            array_merge([
                'name' => $this->getName($node),
            ], $this->getAttributes($node)),
        );
    }

    protected function getName($node)
    {
        preg_match('/preview\/([A-Za-z\/]*)/', $node->getUrl(), $matches);

        return $matches[1] ?? '';
    }

    protected function getAttributes($node)
    {
        // inline&hideSource → ['inline' => '', 'hideSource' => '']
        parse_str(parse_url($node->getUrl(), PHP_URL_QUERY), $attributes);

        // 'hideSource' → 'hide-source'
        $attributes = array_map_keys($attributes, function ($key, $value) {
            $delimiter = '-';

            if (! ctype_lower($key)) {
                $key = preg_replace('/\s+/u', '', ucwords($key));

                $key = strtolower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $key));
            }

            return [
                $key => $value,
            ];
        });

        return $attributes ?? [];
    }
}
