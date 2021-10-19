<?php

namespace Ueberdosis\CommonMark;

use League\CommonMark\Node\Node;
use League\CommonMark\Util\HtmlElement;

interface ServiceInterface
{
    public function render(Node $node): HtmlElement;
}
