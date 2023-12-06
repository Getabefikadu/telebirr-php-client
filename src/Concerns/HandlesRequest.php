<?php


namespace Gta\Telebirr\Concerns;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use Gta\Telebirr\Exceptions\ResponseException;

trait HandlesRequest
{
    /**
     * @return ResponseInterface
     * @throws ResponseException
     */
    private function send()
    {
        try {
            return (new Client())->post($this->getUrl(), [
                RequestOptions::JSON => [
                    [
                        'appid' => $this->app_id,
                        'sign' => $this->sign,
                        'ussd' => $this->ussd
                    ]
                ]
            ]);
        } catch (GuzzleException $e) {
            throw new ResponseException($e->getMessage(), $e->getCode());
        }
    }
}