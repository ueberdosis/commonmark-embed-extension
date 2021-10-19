> We need your support to maintain this package. 💖 https://github.com/sponsors/ueberdosis

# CommonMark Embed Extension

[![](https://img.shields.io/packagist/v/ueberdosis/commonmark-embed-extension.svg)](https://packagist.org/packages/ueberdosis/commonmark-embed-extension)
[![Tests](https://github.com/ueberdosis/commonmark-embed-extension/actions/workflows/test.yml/badge.svg)](https://github.com/ueberdosis/commonmark-embed-extension/actions/workflows/test.yml)
[![](https://img.shields.io/packagist/dt/ueberdosis/commonmark-embed-extension.svg)](https://packagist.org/packages/ueberdosis/commonmark-embed-extension)
[![Sponsor](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub)](https://github.com/sponsors/ueberdosis)

An extension to transform URLs to embeds with [league/commonmark](https://github.com/thephpleague/commonmark).

## Example

### Markdown
```md
OMG, you should see this video:

https://www.youtube.com/watch?v=eX2qFMC8cFo

It‘s amazing, isn’t it?
```

### HTML
```html
<p>OMG, you should see this video:</p>

<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/eX2qFMC8cFo" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>

<p>It‘s amazing, isn’t it?</p>
```

## Installation

You can install the package via composer:

```bash
composer require ueberdosis/commonmark-embed-extension
```

## Supported services

* YouTube
* Vimeo

H[ave a look at the provided services](https://github.com/ueberdosis/commonmark-embed-extension/tree/main/src/Services) to learn how you can add your own integrations. Don’t forget to send a PR with your additions!

## Usage

```php
<?php

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Ueberdosis\CommonMark\EmbedExtension;
use Ueberdosis\CommonMark\Tests\Services\YouTube;
use Ueberdosis\CommonMark\Tests\Services\Vimeo;

// Configure the Environment with all the CommonMark parsers/renderers
$environment = new Environment([
    'embeds' => [
        new YouTube(),
        new Vimeo(),
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

echo $converter->convertToHtml($markdown);
```

## Testing

```bash
composer test
```

## Credits

- [Hans Pagel](https://github.com/hanspagel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
