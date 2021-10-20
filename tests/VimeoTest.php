<?php

namespace Ueberdosis\CommonMark\Tests;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use PHPUnit\Framework\TestCase;
use Ueberdosis\CommonMark\EmbedExtension;
use Ueberdosis\CommonMark\Services\Vimeo;

class VimeoTest extends TestCase
{
    /** @test */
    public function vimeo_url_is_transformed_to_an_embed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new Vimeo(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://vimeo.com/551694700
MARKDOWN;

        $this->assertEquals((string) $converter->convertToHtml($markdown), <<<HTML
<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/551694700" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>

HTML);
    }

    /** @test */
    public function private_vimeo_url_is_transformed_to_an_embed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new Vimeo(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://vimeo.com/551694700/e6d06c6e21
MARKDOWN;

        $this->assertEquals((string) $converter->convertToHtml($markdown), <<<HTML
<div style="padding:56.25% 0 0 0;position:relative;"><iframe src="https://player.vimeo.com/video/551694700?h=e6d06c6e21" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen="" style="position:absolute;top:0;left:0;width:100%;height:100%;"></iframe></div>

HTML);
    }
}
