<?php

namespace App\Http\Response;

class Response implements ResponseInterface
{

    private int $statusCode;
    private array $headers;
    private array $body;

    public function __construct(int $statusCode, array $headers = [], array $body = [])
    {
        $this->statusCode = $statusCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): array
    {
        return $this->body;
    }

}