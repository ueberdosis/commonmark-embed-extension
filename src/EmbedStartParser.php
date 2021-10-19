<?php

namespace Ueberdosis\CommonMark;

use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Parser\MarkdownParserStateInterface;

class EmbedStartParser implements BlockStartParserInterface
{
    protected $embed;

    protected $generator;

    public function __construct($embed)
    {
        $this->embed = $embed;
    }

    public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart
    {
        if ($cursor->isIndented()) {
            return BlockStart::none();
        }

        $url = $cursor->match('/^'.$this->embed::pattern.'$/');

        if ($url === null) {
            return BlockStart::none();
        }

        return BlockStart::of(new EmbedParser($url, $this->embed))->at($cursor);
    }
}
