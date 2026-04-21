<?php

declare(strict_types=1);

namespace App\Support;

/**
 * Utility class for calculating similarity between vectors.
 *
 * @author Albert
 *
 * @since 1.0.0
 */
class Similarity
{
    /**
     * Calculate cosine similarity between two vectors.
     *
     * @param  array  $a  First vector
     * @param  array  $b  Second vector
     * @return float Similarity score between -1 and 1
     */
    public static function cosine(array $a, array $b): float
    {
        $dot = $normA = $normB = 0.0;

        foreach ($a as $i => $v) {
            $dot += $v * $b[$i];
            $normA += $v * $v;
            $normB += $b[$i] * $b[$i];
        }

        return $dot / (sqrt($normA) * sqrt($normB));
    }
}
