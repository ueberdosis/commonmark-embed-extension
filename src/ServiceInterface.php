<?php

namespace Ueberdosis\CommonMark;

use Ueberdosis\CommonMark\Embed;
use League\CommonMark\Util\HtmlElement;

interface ServiceInterface
{
    public function render(Embed $node): HtmlElement;
}
