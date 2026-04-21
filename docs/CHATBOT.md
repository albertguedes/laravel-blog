# Chatbot Documentation

The Laravel Blog features an AI-powered chatbot that answers questions about the blog content using natural language.

## Table of Contents

- [Overview](#overview)
- [How It Works](#how-it-works)
- [Supported Questions](#supported-questions)
- [Adding New Patterns](#adding-new-patterns)
- [Configuration](#configuration)
- [Architecture](#architecture)
- [RAG System](#rag-system)

---

## Overview

The chatbot is accessible at `/chat` and can answer questions about:
- Blog posts and statistics
- Authors and their work
- Categories and tags
- Content-related questions

### Key Features

- **Dual System**: Uses SQL queries for factual data and RAG for content questions
- **Portuguese First**: Optimized for Portuguese language questions
- **Smart Routing**: Automatically routes questions to the appropriate handler
- **Fallback**: Uses RAG when SQL patterns don't match

---

## How It Works

```
User Question
      │
      ▼
QuestionRouterService
      │
      ├── SQL Pattern Matched?
      │     │
      │     ├── YES → SqlAgentService → BlogQueryService → Database
      │     │
      │     └── NO
      │           │
      ▼           ▼
    RAGService
      │
      ├── EmbeddingService → Generate question embedding
      ├── VectorSearchService → Find similar post chunks
      └── LLM (Ollama) → Generate answer from context
```

### Flow Details

1. **Routing**: The `QuestionRouterService` analyzes the question text using regex patterns
2. **SQL Path**: For pattern-matched questions, `SqlAgentService` executes predefined queries
3. **RAG Path**: For content questions, the system uses embeddings + LLM

---

## Supported Questions

### Posts

| Question | Description |
|----------|-------------|
| `quantos posts existem?` | Count of all posts |
| `quantos posts publicados?` | Count of published posts |
| `últimos 10 posts` | 10 most recent posts |
| `posts recentes` | 5 most recent posts |
| `posts do autor João` | Posts by specific author |
| `posts da categoria PHP` | Posts in specific category |
| `posts com tag laravel` | Posts with specific tag |
| `posts populares` | Most viewed/popular posts |
| `listar posts` | List all posts |

### Authors

| Question | Description |
|----------|-------------|
| `quem são os autores?` | List all authors |
| `autores dos posts` | List authors who have published |
| `lista de autores` | List all authors |
| `mostrar autores` | List all authors |
| `listar autores` | List all authors |
| `autores ativos` | Active authors |
| `autores inativos` | Inactive authors |
| `autor com mais posts` | Author with most posts |
| `posts do autor` | Posts by specific author |

### Categories

| Question | Description |
|----------|-------------|
| `posts da categoria PHP` | Posts in category |
| `categoria laravel` | Posts in specific category |
| `categorias com mais posts` | Categories sorted by post count |
| `categorias com menos posts` | Categories with fewest posts |

### Tags

| Question | Description |
|----------|-------------|
| `posts com tag testing` | Posts with specific tag |
| `posts com a tag laravel` | Posts with specific tag |
| `tag php` | Posts with specific tag |

### Statistics

| Question | Description |
|----------|-------------|
| `estatísticas do blog` | Blog statistics |
| `resumo do blog` | Blog summary |
| `mais posts` | Authors/categories with most posts |
| `menos posts` | Authors/categories with fewest posts |

---

## Adding New Patterns

### Step 1: Add Router Pattern

Edit `app/Services/QuestionRouterService.php`:

```php
// Add to the patterns array
'/your\s+new\s+pattern/i',
```

### Step 2: Add Handler Method

Edit `app/Services/SqlAgentService.php`:

```php
// Add condition in answer() method
if (preg_match('/your\s+new\s+pattern/i', $question)) {
    return $this->handleYourNewFeature($question);
}

// Add handler method
private function handleYourNewFeature(string $question): string
{
    // Query logic here
    $data = $this->queryService->yourQuery();

    // Format response
    return "Your formatted response...";
}
```

### Step 3: Add Query Method (if needed)

Edit `app/Services/BlogQueryService.php`:

```php
public function yourQuery(): Collection
{
    return YourModel::query()->get();
}
```

### Step 4: Add Tests

Create or update tests in `tests/Unit/Services/QuestionRouterServiceTest.php`:

```php
it('routes "your question" to SQL', function () {
    expect($this->service->route('your question'))
        ->toBe(QuestionRouterService::INTENT_SQL);
});
```

### Pattern Best Practices

1. **Case Insensitivity**: Use `mb_strtolower()` and `/i` flag
2. **Accent Support**: Use character classes like `[a-zà-ÿ]` for Portuguese
3. **Optional Parts**: Use `(optional)?` in patterns
4. **Word Boundaries**: Use `\b` when appropriate

---

## Configuration

### Ollama Settings (.env)

```env
OLLAMA_MODEL=mannix/llama3.1-8b-abliterated:q4_K_M
OLLAMA_URL=http://127.0.0.1:11434
OLLAMA_CONNECTION_TIMEOUT=300
```

### Model Recommendations

**For Chat:**
- `llama2` - General purpose
- `llama3` - Better reasoning
- `mannix/llama3.1-8b-abliterated:q4_K_M` - Optimized

**For Embeddings:**
- `nomic-embed-text` - Fast, good quality
- `mxbai-embed-large` - Higher quality

### Temperature Setting

The chatbot uses low temperature (0.2) for consistent, factual answers:

```php
->options(['temperature' => 0.2])
```

Lower = more deterministic, Higher = more creative

---

## Architecture

### Services

| Service | Responsibility |
|---------|----------------|
| `ChatService` | Main orchestration, coordinates router and agents |
| `QuestionRouterService` | Routes questions to SQL or RAG |
| `SqlAgentService` | Handles SQL-based questions |
| `RAGService` | Handles content-based questions via RAG |
| `BlogQueryService` | Reusable database query functions |
| `EmbeddingService` | Generates text embeddings |
| `VectorSearchService` | Finds similar content using embeddings |
| `BlogContextService` | Provides static blog context |

### Class Diagram

```
ChatService
    │
    ├── QuestionRouterService
    │       └── route(question) → INTENT_SQL | INTENT_RAG
    │
    ├── SqlAgentService
    │       ├── answer(question)
    │       ├── handleRecentPosts()
    │       ├── handlePostsByAuthor()
    │       ├── handleListAuthors()
    │       └── ... (handlers)
    │
    └── RAGService
            ├── answer(question)
            ├── BlogContextService (static info)
            ├── EmbeddingService (embed text)
            └── VectorSearchService (similarity search)
```

---

## RAG System

RAG (Retrieval-Augmented Generation) is used for content-based questions that don't match SQL patterns.

### How RAG Works

1. **Indexing**: Post content is chunked and stored with embeddings in `post_chunks` table
2. **Query**: User question is embedded using `EmbeddingService`
3. **Search**: `VectorSearchService` finds most similar chunks
4. **Generation**: LLM generates answer from retrieved chunks

### Embedding Generation

When posts are created/updated:

```php
$chunks = TextChunker::chunk($post->content);
foreach ($chunks as $chunk) {
    $embedding = $EmbeddingService->embed($chunk);
    PostChunk::create([
        'post_id' => $post->id,
        'content' => $chunk,
        'embedding' => json_encode(['embedding' => $embedding]),
    ]);
}
```

### Similarity Search

```php
$questionVector = $EmbeddingService->embed($question);
$chunks = $VectorSearchService->findSimilar($questionVector, 5);
```

### Prompt Template

```php
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
```

### Chunking Strategy

Posts are chunked by paragraphs with overlap:
- Max chunk size: 500 characters
- Overlap: 50 characters
- Preserves semantic meaning

---

## Troubleshooting

### Chatbot Returns Empty Response

1. Check if Ollama is running: `curl http://127.0.0.1:11434/api/tags`
2. Check model is available: `ollama list`
3. Check logs: `tail -f storage/logs/laravel.log`

### Wrong Answers

1. RAG may not have relevant chunks indexed
2. Try rebuilding embeddings for posts
3. Check if question matches SQL pattern

### Slow Responses

1. Large model being loaded
2. High temperature causing more computation
3. Network latency to Ollama server

### Vector Search Returns No Results

1. Check `post_chunks` table has data
2. Verify embeddings are properly stored
3. Check similarity threshold in `VectorSearchService`

---

## Database Tables

### post_chunks

Stores chunked post content with embeddings for RAG:

| Column | Type | Description |
|--------|------|-------------|
| id | integer | Primary key |
| post_id | integer | Foreign key to posts |
| content | text | Text chunk |
| embedding | json | Vector embedding |
| created_at | timestamp | Creation time |
| updated_at | timestamp | Last update time |

---

## Related Documentation

- [Architecture](ARCHITECTURE.md) - System architecture details
- [Developer Guide](DEVELOPER-GUIDE.md) - General development info
