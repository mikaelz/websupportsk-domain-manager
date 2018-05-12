<?php

namespace Websupport;

class Api
{
    const API_URL = 'https://rest.websupport.sk/v1';

    /**
     * @var string $auth_token
     */
    private $auth_token;

    /**
     * Constructor
     *
     * @param string $auth_token Auth token.
     */
    public function __construct($auth_token)
    {
        if (empty($auth_token)) {
            throw new \Exception('Missing auth token.');
        }

        $this->auth_token = $auth_token;
    }

    /**
     * Make remote HTTP call
     *
     * @param string $query Query path.
     * @param array $data Request data.
     * @param string $method HTTP method type.
     */
    public function request($query, $data = [], $method = 'GET')
    {
        $header = [
            'Content-Type: application/json',
            'Authorization: Basic '.$this->auth_token,
        ];

        $ch = curl_init(self::API_URL.$query);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }
}
