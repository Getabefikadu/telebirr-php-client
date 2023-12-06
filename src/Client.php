<?php


namespace Gta\Telebirr;


use Exception;
use Psr\Http\Message\ResponseInterface;
use Gta\Telebirr\Concerns\HandlesUssd;
use Gta\Telebirr\Concerns\HandlesSign;
use Gta\Telebirr\Concerns\HandlesRequest;
use Gta\Telebirr\Concerns\HandlesEncryptionAndDecryption;

class Client extends BaseClient
{
    use HandlesUssd, HandlesSign, HandlesEncryptionAndDecryption, HandlesRequest;

    /**
     * @var string $sign
     */
    private $sign;

    /**
     * @var string $ussd
     */
    private $ussd;

    /**
     * @return ResponseInterface
     * @throws Exceptions\ConfigException
     * @throws Exceptions\ResponseException
     * @throws Exception
     */
    public function request()
    {
        if (!$this->nonce) {
            $this->setNonce($this->generateRandomString());
        }

        if (!$this->timestamp) {
            $this->setTimestamp($this->timestamp());
        }

        $ussd = $this->mapUssd();
        $this->sign = $this->sign($ussd);
        $this->ussd = $this->encrypt(json_encode($ussd));

        return $this->send();
    }

    /**
     * @param string $data
     *
     * @return array
     * @throws Exceptions\ConfigException
     */
    public function response($data)
    {
        $result = $this->decrypt($data);

        return (array) json_decode($result);
    }
}