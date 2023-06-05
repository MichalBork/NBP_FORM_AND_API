<?php

namespace Http\Request;

use GuzzleHttp\Psr7\Response;
use HttpException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\GuzzleException;

class ApiClient implements ClientInterface
{
    private GuzzleHttpClient $guzzleHttpClient;

    public function __construct()
    {
        $this->guzzleHttpClient = new GuzzleHttpClient();
    }

    /**
     * @throws HttpException
     */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        try {
            $guzzleResponse = $this->guzzleHttpClient->send($request);
            return new Response(
                $guzzleResponse->getStatusCode(),
                $guzzleResponse->getHeaders(),
                $guzzleResponse->getBody()
            );
        } catch (GuzzleException $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }

}