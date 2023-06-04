<?php

namespace Response;

interface ResponseInterface
{
    public function getStatusCode(): int;
    public function getHeaders(): array;
    public function getBody(): array;

}