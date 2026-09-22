<?php

namespace App\http;

class Request
{
    public string $uri;
    public string $method;

    public function __construct(
        private array $postParams,
        private array $getParams,
        private array $server
    ) {
        $this->uri = parse_url($this->server["REQUEST_URI"])['path'];
        $this->method = strtolower($this->server["REQUEST_METHOD"]);
    }

    public static function getFromGlobal(): self
    {
        return new self($_POST, $_GET, $_SERVER);
    }

    public function isPost(): bool
    {
        if ($this->method === "post") {
            return true;
        } else {
            return false;
        }
    }

    public function getURI(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function get(mixed $default = null): mixed
    {
        return $this->getParams ?? $default;
    }

    public function post(mixed $default = null): mixed
    {
        return $this->postParams ?? $default;
    }
}