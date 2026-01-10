<?php declare(strict_types=1);

namespace App\Services;

use Cloudstudio\Ollama\Facades\Ollama;

use App\Services\BlogContextService;
use App\Services\EmbeddingService;
use App\Services\VectorSearchService;

class RAGService
{
    public function __construct(
        private BlogContextService $blogContext,
        private EmbeddingService $embeddingService,
        private VectorSearchService $vectorSearchService
    ) {}

    public function answer(string $question): string
    {
        $blogContext = $this->blogContext->get();

        $questionVector = $this->embeddingService->embed($question);
        $chunks = $this->vectorSearchService->findSimilar($questionVector, 5);
        $context = $chunks->pluck('content')->implode("\n\n");

        $prompt = <<<PROMPT
INFORMAÇÕES FIXAS DO BLOG:
{$blogContext}

CONTEÚDO DO BLOG (TRECHOS RELEVANTES):
{$context}

REGRAS:
- Use apenas as informações acima.
- Se a resposta não estiver contida nelas, diga que não sabe.

PERGUNTA:
{$question}
PROMPT;

        $response = Ollama::agent('Você responde usando apenas o conteúdo fornecido.')
                            ->prompt($prompt)
                            ->model(config('ollama-laravel.model'))
                            ->options(['temperature' => 0.2])
                            ->ask();

        return $response['response'];
    }
}
