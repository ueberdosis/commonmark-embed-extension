<?php

namespace Ueberdosis\CommonMark\Tests\Services;

use League\CommonMark\Util\HtmlElement;
use Ueberdosis\CommonMark\Embed;
use Ueberdosis\CommonMark\ServiceInterface;

class CustomEmbed implements ServiceInterface
{
    public const pattern = 'https:\/\/example\.com\/custom\/([A-Za-z\/]*)(\?[A-Za-z&]*)?';

    public function render(Embed $node): HtmlElement
    {
        return new HtmlElement(
            'custom-embed',
            array_merge([
                'name' => $this->getName($node),
            ], $this->getAttributes($node)),
        );
    }

    protected function getName($node)
    {
        preg_match('/'.self::pattern.'/', $node->getUrl(), $matches);

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
