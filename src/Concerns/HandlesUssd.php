<?php


namespace Gta\Telebirr\Concerns;


use Exception;

trait HandlesUssd
{
    /**
     * @return  array
     */
    private function mapUssd()
    {
        return [
            'appId' => $this->getAppId(),
            'appKey' => $this->getAppKey(),
            'shortCode'  => $this->getShortCode(),
            'receiveName'  => $this->getReceiveName(),
            'timeoutExpress'  => $this->getTimeoutExpress(),
            'notifyUrl'  => $this->getNotifyUrl(),
            'nonce'  => $this->getNotifyUrl(),
            'timestamp'  => $this->getNotifyUrl(),
            'outTradeNo'  => $this->getTradeNumber(),
            'subject'  => $this->getSubject(),
            'totalAmount'  => $this->getAmount(),
            'returnUrl'  => $this->getCallbackUrl()
        ];
    }

    /**
     * @param int $length
     *
     * @return  string
     * @throws Exception
     */
    private function generateRandomString($length = 32)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters_length = strlen($characters);

        $random = '';
        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[random_int(0, $characters_length - 1)];
        }

        return $random;
    }

    /**
     * @return  string
     */
    private function timestamp()
    {
        return time();
    }
}