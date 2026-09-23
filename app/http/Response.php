<?php

namespace App\http;

use App\view\View;

/**
 * Format for response sending from server to client
 */
class Response
{
    public function __construct(
        private ?View $content = null, 
        private int $statusCode = 200, 
        private array $headers = []
    ) {}

    public function setHeader(string $newHeader): self
    {
        $this->headers[] = $newHeader;
        return $this;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getContent(): View
    {
        return $this->content;
    }

    /**
     * Manual send trigger for response
     *
     * @return void
     */
    public function send()
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $header) {
            header($header);
        }
    }
}