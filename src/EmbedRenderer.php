<?php

namespace Ueberdosis\CommonMark;

use League\CommonMark\Node\Node;
use League\CommonMark\Renderer\ChildNodeRendererInterface;
use League\CommonMark\Renderer\NodeRendererInterface;

final class EmbedRenderer implements NodeRendererInterface
{
    /**
     * @param Embed $node
     *
     * @inheritDoc
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     */
    public function render(Node $node, ChildNodeRendererInterface $childRenderer): \Stringable
    {
        Embed::assertInstanceOf($node);

        return $node->getService()->render($node);
    }
}
