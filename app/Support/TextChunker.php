<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Utility class for splitting text into chunks.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class TextChunker
{
    /**
     * Split text into fixed-size chunks.
     *
     * @param  string  $text  The text to chunk
     * @param  int  $size  The chunk size in characters
     * @return array Array of text chunks
     */
    public static function chunk(string $text, int $size = 500): array
    {
        return str_split($text, $size);
    }
}
