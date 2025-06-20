<?php

namespace Webites\WebfleetPhpClient\Request;

use Webites\WebfleetPhpClient\Client\Client;

abstract class AbstractRequest
{
    protected Client $client;
    protected array $queryParams = [];

    protected string $fullUrl = '';

    protected const ENDPOINT = '';
    protected const METHOD = 'GET';
    protected const ACTION = '';
    public function __construct(
        Client $client,
        array $queryParams = []
    ) {
        $this->client = $client;
        $this->queryParams = $queryParams;

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
}
