<?php

namespace Ueberdosis\CommonMark\Tests;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use PHPUnit\Framework\TestCase;
use Ueberdosis\CommonMark\EmbedExtension;
use Ueberdosis\CommonMark\Tests\Services\TiptapEmbed;

class EmbedExtensionTest extends TestCase
{
    /** @test */
    public function url_is_transformed_to_an_embed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new TiptapEmbed(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://embed.tiptap.dev/preview/Example/Default
MARKDOWN;

        $this->assertEquals((string) $converter->convertToHtml($markdown), <<<HTML
<tiptap-demo name="Example/Default"></tiptap-demo>

HTML);
    }

    /** @test */
    public function inline_parameter_is_passed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new TiptapEmbed(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://embed.tiptap.dev/preview/Example/Default?inline
MARKDOWN;

        $expected = <<<HTML
<tiptap-demo name="Example/Default" inline=""></tiptap-demo>

HTML;
        $this->assertEquals($expected, (string) $converter->convertToHtml($markdown));
    }

    /** @test */
    public function hide_source_parameter_is_passed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new TiptapEmbed(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://embed.tiptap.dev/preview/Example/Default?hideSource
MARKDOWN;

        $expected = <<<HTML
<tiptap-demo name="Example/Default" hide-source=""></tiptap-demo>

HTML;
        $this->assertEquals($expected, (string) $converter->convertToHtml($markdown));
    }
}
