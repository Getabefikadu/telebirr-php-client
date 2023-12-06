<?php


namespace Gta\Telebirr\Concerns;


trait HandlesSign
{
    /**
     * @param array $data
     *
     * @return string
     */
    private function sign(array $data)
    {
        $raw = $this->sort($data);

        return hash("sha256", $raw);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    private function sort(array $data)
    {
        ksort($data);

        $result = '';
        foreach ($data as $key => $value) {
            if (empty($result)) {
                $result = "{$key}={$value}";
                continue;
            }

            $result = "{$result}&{$key}={$value}";
        }

        return $result;
    }
}