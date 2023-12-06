<?php


namespace Gta\Telebirr\Concerns;


use phpseclib3\Crypt\PublicKeyLoader;
use Gta\Telebirr\Exceptions\ConfigException;

trait HandlesEncryptionAndDecryption
{
    /**
     * @param string $data
     * @param int $chunk_size
     *
     * @return string
     * @throws ConfigException
     */
    private function encrypt($data, $chunk_size = 117)
    {
        $result = '';
        $chunks = str_split($data, $chunk_size);

        foreach ($chunks as $chunk) {
            $status = openssl_public_encrypt(
                $chunk,
                $encrypted,
                PublicKeyLoader::load($this->getPublicKey()),
                OPENSSL_PKCS1_PADDING
            );

            if (!$status) {
                throw new ConfigException('Failed to encrypt data.');
            }

            $result .= $encrypted;
        }

        return base64_encode($result);
    }

    /**
     * @param string $data
     * @param int $chunk_size
     *
     * @return string
     * @throws ConfigException
     */
    private function decrypt($data, $chunk_size = 256)
    {
        $result = '';
        $chunks = str_split(base64_decode($data), $chunk_size);

        foreach ($chunks as $chunk) {
            $status = openssl_public_decrypt(
                $chunk,
                $decrypted,
                PublicKeyLoader::load($this->getPublicKey()),
                OPENSSL_PKCS1_PADDING
            );

            if (!$status) {
                throw new ConfigException('Failed to decrypt data.');
            }

            $result .= $decrypted;
        }

        return $result;
    }
}