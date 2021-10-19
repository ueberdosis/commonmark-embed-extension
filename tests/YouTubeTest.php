<?php

namespace Ueberdosis\CommonMark\Tests;

use PHPUnit\Framework\TestCase;
use League\CommonMark\MarkdownConverter;
use Ueberdosis\CommonMark\EmbedExtension;
use Ueberdosis\CommonMark\Services\YouTube;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;

class YouTubeTest extends TestCase
{
    /** @test */
    public function youtube_url_is_transformed_to_an_embed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new YouTube(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://www.youtube.com/watch?v=eX2qFMC8cFo
MARKDOWN;

        $this->assertEquals((string) $converter->convertToHtml($markdown), <<<HTML
<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/eX2qFMC8cFo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

HTML);
    }
}
