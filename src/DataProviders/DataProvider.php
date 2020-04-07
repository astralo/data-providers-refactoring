<?php

declare(strict_types=1);

namespace App\DataProviders;

class DataProvider implements DataProviderInterface
{
    private string $host;
    private string $user;
    private string$password;

    /**
     * @param string $host
     * @param string $user
     * @param string $password
     */
    public function __construct(string $host, string $user, string $password)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * @param array $params
     *
     * @return array
     * @throws \Exception
     */
    public function get(array $params): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host . '?' . http_build_query($params));
        curl_setopt($ch, CURLOPT_USERPWD, $this->user . ":" . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception(curl_error($ch));
        }
        curl_close($ch);

        $result = json_decode($output, true);

        return !is_array($result) ? $result : [];
    }
}
