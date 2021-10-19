> We need your support to maintain this package. 💖 https://github.com/sponsors/ueberdosis

# CommonMark Hint Extension

[![](https://img.shields.io/packagist/v/ueberdosis/commonmark-embed-extension.svg)](https://packagist.org/packages/ueberdosis/commonmark-embed-extension)
[![Tests](https://github.com/ueberdosis/commonmark-embed-extension/actions/workflows/test.yml/badge.svg)](https://github.com/ueberdosis/commonmark-embed-extension/actions/workflows/test.yml)
[![](https://img.shields.io/packagist/dt/ueberdosis/commonmark-embed-extension.svg)](https://packagist.org/packages/ueberdosis/commonmark-embed-extension)
[![Sponsor](https://img.shields.io/static/v1?label=Sponsor&message=%E2%9D%A4&logo=GitHub)](https://github.com/sponsors/ueberdosis)

A hint extension for [league/commonmark](https://github.com/thephpleague/commonmark) that renders the following Markdown as HTML.

## Example

### Markdown
```md
TODO
```

### HTML
```html
TODO
```

## Installation

You can install the package via composer:

```bash
composer require ueberdosis/commonmark-embed-extension
```

## Usage

```php
<?php

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Ueberdosis\CommonMark\EmbedExtension;

// Configure the Environment with all the CommonMark parsers/renderers
$environment = new Environment([
    'embeds' => [
        // TODO
    ],
]);
$environment->addExtension(new CommonMarkCoreExtension());

// Add this extension
$environment->addExtension(new EmbedExtension());

// Instantiate the converter engine and start converting some Markdown!
$converter = new MarkdownConverter($environment);
$markdown = <<<MARKDOWN
TODO
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
