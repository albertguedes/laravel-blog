<?php declare(strict_types=1);

namespace App\Support;

class TextChunker
{
    public static function chunk(string $text, int $size = 500): array
    {
        return str_split($text, $size);
    }
}
