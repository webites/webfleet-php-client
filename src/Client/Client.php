<?php

namespace Webites\WebfleetPhpClient\Client;
class Client extends \GuzzleHttp\Client
{
    private string $url = 'https://csv.webfleet.com/';
    private string $lang = 'pl';
    public function __construct(
        private string $username,
        private string $password,
        private string $account = '',
        ?string $url = null,
        private ?string $token = null,
        ?string $lang = 'pl'
    ) {
        if ($url) {
            $this->url = rtrim($url, '/') . '/';
        }
        if ($lang) {
            $this->lang = $lang;
        }
        parent::__construct([
            'base_uri' => $this->url,
            'auth' => [$this->username, $this->password],
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getLang(): string
    {
        return $this->lang;
    }

    public function getAccount() : string
    {
        return $this->account;
    }
}
