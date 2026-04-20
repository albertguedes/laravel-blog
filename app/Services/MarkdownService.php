<?php

declare(strict_types=1);

namespace App\Services;

use League\CommonMark\MarkdownConverter;

class MarkdownService
{
    public function __construct(
        private MarkdownConverter $converter
    ) {}

    public function parse(string $markdown): string
    {
        $rendered = $this->converter->convert($markdown);
        $html = (string) $rendered;

        return $this->sanitize($html);
    }

    private function sanitize(string $html): string
    {
        $dom = new \DOMDocument;

        libxml_use_internal_errors(true);
        $dom->loadHTML('<html><body>'.$html.'</body></html>');
        libxml_clear_errors();

        $body = $dom->getElementsByTagName('body')->item(0);

        if (! $body) {
            return '';
        }

        $this->processNode($body);

        $result = '';
        foreach ($body->childNodes as $child) {
            $result .= $dom->saveHTML($child);
        }

        return $result;
    }

    private function processNode(\DOMNode $node): void
    {
        if ($node->nodeType === XML_ELEMENT_NODE) {
            $allowedTags = ['a', 'strong', 'b', 'em', 'i', 'br', 'p', 'ul', 'ol', 'li', 'body', 'html'];

            if (! in_array($node->nodeName, $allowedTags, true)) {
                $this->replaceWithChildren($node);

                return;
            }

            if ($node->nodeName === 'a') {
                $href = $node->getAttribute('href');

                if ($href === '') {
                    $this->replaceWithChildren($node);

                    return;
                }

                if (str_starts_with($href, '/')) {
                    return;
                }

                if ($node->parentNode) {
                    $text = $node->textContent;
                    $strong = $node->ownerDocument->createElement('strong');
                    $strong->textContent = $text.' ('.$href.')';
                    $node->parentNode->replaceChild($strong, $node);

                    return;
                }
            }
        }

        foreach ($node->childNodes as $child) {
            $this->processNode($child);
        }
    }

    private function replaceWithChildren(\DOMNode $node): void
    {
        $parent = $node->parentNode;

        if (! $parent) {
            return;
        }

        $fragment = $node->ownerDocument->createDocumentFragment();

        while ($node->firstChild) {
            $fragment->appendChild($node->firstChild);
        }

        $parent->replaceChild($fragment, $node);
    }
}
