<?php

namespace Ueberdosis\CommonMark;

use League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use League\CommonMark\Parser\Block\BlockContinue;
use League\CommonMark\Parser\Block\BlockContinueParserInterface;
use League\CommonMark\Parser\Cursor;

final class EmbedParser extends AbstractBlockContinueParser implements BlockContinueParserInterface
{
    /** @psalm-readonly */
    private Embed $block;

    private $service;

    public function __construct($url, $service)
    {
        $this->block = new Embed($url, $service);
    }

    public function getBlock(): Embed
    {
        return $this->block;
    }

    public function tryContinue(Cursor $cursor, BlockContinueParserInterface $activeBlockParser): ?BlockContinue
    {
        return BlockContinue::none();
    }
}
