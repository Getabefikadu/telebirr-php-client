<?php


namespace Gta\Telebirr;


use Gta\Telebirr\Exceptions\ConfigException;
use Gta\Telebirr\Exceptions\ParameterException;

abstract class BaseClient
{
    /**
     * @var string $url
     */
    protected $url;

    /**
     * @var string $app_id
     */
    protected $app_id;

    /**
     * @var string $app_key
     */
    protected $app_key;

    /**
     * @var string $public_key
     */
    protected $public_key;

    /**
     * @var string $short_code
     */
    protected $short_code;

    /**
     * @var string $receive_name
     */
    protected $receive_name;

    /**
     * @var string $timeout_express
     */
    protected $timeout_express;

    /**
     * @var string $notify_url
     */
    protected $notify_url;

    /**
     * @var string $nonce
     */
    protected $nonce;

    /**
     * @var string $timestamp
     */
    protected $timestamp;

    /**
     * @var string $trade_number
     */
    protected $trade_number;

    /**
     * @var string $subject
     */
    protected $subject;

    /**
     * @var string $amount
     */
    protected $amount;

    /**
     * @var string $callback_url
     */
    protected $callback_url;

    /**
     * @throws ConfigException
     */
    public function __construct()
    {
        $this->url = $this->setUrl(config('url'));
        $this->public_key = $this->setPublicKey(config('public_key'));
        $this->app_id = $this->setAppId(config('app_id'));
        $this->app_key = $this->setAppKey(config('app_key'));
        $this->short_code = $this->setShortCode(config('short_code'));
        $this->receive_name = $this->setReceiveName(config('receive_name'));
        $this->timeout_express = $this->setTimeoutExpress(config('timeout_express'));
        $this->notify_url = $this->setNotifyUrl(config('notify_url'));
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getPublicKey()
    {
        return $this->public_key;
    }

    /**
     * @param string $public_key
     *
     * @return $this
     * @throws ConfigException
     */
    public function setPublicKey($public_key)
    {
        $split = chunk_split($public_key, 64, "\n");
        $key = openssl_pkey_get_public("-----BEGIN PUBLIC KEY-----\n{$split}-----END PUBLIC KEY-----\n");

        if (!$key) {
            throw new ConfigException('Invalid public key.', 404);
        }

        $this->public_key = $key;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param string $app_id
     * @return $this
     */
    public function setAppId($app_id)
    {
        $this->app_id = $app_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getAppKey()
    {
        return $this->app_key;
    }

    /**
     * @param string $app_key
     * @return $this
     */
    public function setAppKey($app_key)
    {
        $this->app_key = $app_key;

        return $this;
    }

    /**
     * @return string
     */
    public function getShortCode()
    {
        return $this->short_code;
    }

    /**
     * @param string $short_code
     * @return $this
     */
    public function setShortCode($short_code)
    {
        $this->short_code = $short_code;

        return $this;
    }

    /**
     * @return string
     */
    public function getReceiveName()
    {
        return $this->receive_name;
    }

    /**
     * @param string $receive_name
     * @return $this
     */
    public function setReceiveName($receive_name)
    {
        $this->receive_name = $receive_name;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimeoutExpress()
    {
        return $this->timeout_express;
    }

    /**
     * @param string $timeout_express
     * @return $this
     */
    public function setTimeoutExpress($timeout_express)
    {
        $this->timeout_express = $timeout_express;

        return $this;
    }

    /**
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->notify_url;
    }

    /**
     * @param string $notify_url
     * @return $this
     */
    public function setNotifyUrl($notify_url)
    {
        $this->notify_url = $notify_url;

        return $this;
    }

    /**
     * @return string
     */
    public function getNonce()
    {
        return $this->nonce;
    }

    /**
     * @param string $nonce
     * @return $this
     */
    public function setNonce($nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @param string $timestamp
     * @return $this
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * @return string
     * @throws ParameterException
     */
    public function getTradeNumber()
    {
        if (!$this->trade_number) throw new ParameterException('Trade number is missing.', 400);

        return $this->trade_number;
    }

    /**
     * @param string $trade_number
     *
     * @return $this
     */
    public function setTradeNumber($trade_number)
    {
        $this->trade_number = $trade_number;

        return $this;
    }

    /**
     * @return string
     * @throws ParameterException
     */
    public function getSubject()
    {
        if (!$this->subject) throw new ParameterException('Subject is missing.', 400);

        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return string
     * @throws ParameterException
     */
    public function getAmount()
    {
        if (!$this->amount) throw new ParameterException('Amount is missing.', 400);

        return $this->amount;
    }

    /**
     * @param string $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return string
     * @throws ParameterException
     */
    public function getCallbackUrl()
    {
        if (!$this->callback_url) throw new ParameterException('Callback url is missing.', 400);

        return $this->callback_url;
    }

    /**
     * @param string $callback_url
     *
     * @return $this
     */
    public function setCallbackUrl($callback_url)
    {
        $this->callback_url = $callback_url;

        return $this;
    }
}