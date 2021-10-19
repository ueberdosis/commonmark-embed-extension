<?php

namespace Ueberdosis\CommonMark;

use League\CommonMark\Util\HtmlElement;

interface ServiceInterface
{
    public function render(Embed $node): HtmlElement;
}
