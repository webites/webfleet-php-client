<?php

namespace Webites\WebfleetPhpClient\Request;

use Psr\Log\LoggerInterface;
use Webites\WebfleetPhpClient\Client\Client;

abstract class AbstractRequest
{
    protected Client $client;
    protected array $queryParams = [];

    protected string $fullUrl = '';

    protected const ENDPOINT = '';
    protected const METHOD = 'GET';
    protected const ACTION = '';

    protected LoggerInterface $logger;

    public function __construct(
        Client $client,
        array $queryParams = [],
        ?LoggerInterface $logger = null
    ) {
        $this->client = $client;
        $this->queryParams = $queryParams;
        $this->logger = $logger;

        if (empty($this->client->getToken())) {
            throw new \RuntimeException('API token is not set. Please provide a valid token.');
        }

        $this->buildEndpoint();
    }

    public function buildEndpoint()
    {
        if (empty(static::ENDPOINT)) {
            throw new \RuntimeException('Endpoint is not defined for this request.');
        }

        $this->queryParams['apikey'] = $this->client->getToken();
        $this->queryParams['action'] = $this::ACTION;
        $this->queryParams['lang'] = $this->client->getLang();
        $this->queryParams['account'] = $this->client->getAccount();
        if (!isset($this->queryParams['outputformat'])) {
            $this->queryParams['outputformat'] = 'json';
        }

        $queryString = http_build_query($this->queryParams);

        $fullUrl = sprintf(
            '%s%s?%s',
            $this->client->getUrl(),
            static::ENDPOINT,
            $queryString
        );

        $this->fullUrl = $fullUrl;

        return $this->fullUrl;
    }

    abstract public function handle(): mixed;

    protected function logError(
        \Throwable $exception,
    ) : void {
        if ($this->logger) {
            $this->logger->error(
                'An error occurred in request: ' . $exception->getMessage(),
                [
                    'exception' => $exception,
                    'request_url' => $this->fullUrl,
                    'query_params' => $this->queryParams,
                ]
            );
        }
    }
}
