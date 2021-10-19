<?php

namespace Ueberdosis\CommonMark\Tests;

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use PHPUnit\Framework\TestCase;
use Ueberdosis\CommonMark\EmbedExtension;
use Ueberdosis\CommonMark\Tests\Services\CustomEmbed;

class CustomEmbedExtensionTest extends TestCase
{
    /** @test */
    public function url_is_transformed_to_an_embed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new CustomEmbed(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://example.com/custom/Example/Default
MARKDOWN;

        $this->assertEquals((string) $converter->convertToHtml($markdown), <<<HTML
<custom-embed name="Example/Default"></custom-embed>

HTML);
    }

    /** @test */
    public function inline_parameter_is_passed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new CustomEmbed(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://example.com/custom/Example/Default?inline
MARKDOWN;

        $expected = <<<HTML
<custom-embed name="Example/Default" inline=""></custom-embed>

HTML;
        $this->assertEquals($expected, (string) $converter->convertToHtml($markdown));
    }

    /** @test */
    public function hide_source_parameter_is_passed()
    {
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment([
            'embeds' => [
                new CustomEmbed(),
            ],
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add this extension
        $environment->addExtension(new EmbedExtension());

        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);
        $markdown = <<<MARKDOWN
https://example.com/custom/Example/Default?hideSource
MARKDOWN;

        $expected = <<<HTML
<custom-embed name="Example/Default" hide-source=""></custom-embed>

HTML;
        $this->assertEquals($expected, (string) $converter->convertToHtml($markdown));
    }
}
