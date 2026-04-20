<?php

declare(strict_types=1);

namespace App\Agents;

use App\Tools\PageLinksTool;
use App\Tools\QueryDatabaseTool;
use App\Tools\SearchPostsTool;
use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Support\Facades\Log;

/**
 * Chat agent that routes questions to appropriate tools.
 *
 * This agent uses Ollama to understand user questions and decides
 * whether to use the database query tool, page links tool, or the RAG search tool.
 * Falls back to RAG if database query fails.
 *
 * @category Agents
 */
class ChatAgent
{
    public function __construct(
        private PageLinksTool $pageLinksTool,
        private QueryDatabaseTool $queryDatabaseTool,
        private SearchPostsTool $searchPostsTool
    ) {}

    /**
     * Answer a user question using appropriate tools.
     *
     * @param  string  $question  The user's question
     * @return string Natural language answer
     */
    public function answer(string $question): string
    {
        $result = $this->pageLinksTool->query($question);

        if ($result['success']) {
            return $result['answer'];
        }

        Log::debug('ChatAgent: page_links failed, trying query_database', [
            'question' => $question,
            'result' => $result,
        ]);

        $dbResult = $this->queryDatabaseTool->query($question);

        if ($dbResult['success']) {
            return $dbResult['answer'];
        }

        Log::debug('ChatAgent: query_database failed, falling back to search_posts', [
            'question' => $question,
            'result' => $dbResult,
        ]);

        return $this->searchPostsTool->search($question)['answer'];
    }

    /**
     * Ask the agent with full tool routing.
     *
     * @param  string  $question  The user's question
     * @return string Natural language answer
     */
    public function ask(string $question): string
    {
        try {
            $pageResult = $this->pageLinksTool->query($question);

            if ($pageResult['success']) {
                return $pageResult['answer'];
            }

            $dbResult = $this->queryDatabaseTool->query($question);

            if ($dbResult['success']) {
                return $dbResult['answer'];
            }

            if ($dbResult['should_fallback']) {
                Log::debug('ChatAgent: should fallback, using search_posts');

                return $this->searchPostsTool->search($question)['answer'];
            }

            return $this->searchPostsTool->search($question)['answer'];
        } catch (\Throwable $e) {
            Log::error('ChatAgent: Error processing question', [
                'error' => $e->getMessage(),
                'question' => $question,
            ]);

            try {
                return $this->searchPostsTool->search($question)['answer'];
            } catch (\Throwable $e2) {
                Log::error('ChatAgent: Fallback also failed', [
                    'error' => $e2->getMessage(),
                ]);

                return 'Desculpe, ocorreu um erro ao processar sua pergunta. Tente novamente.';
            }
        }
    }
}
