<?php

namespace CmsBundle\Bridge;
/**
 * Class Bridge for using Library for sending third party requests
 * Curl Requests
 */
class HttpClient
{

    private $lib;

    public function __construct()
    {
        $this->lib = new \GuzzleHttp\Client();
    }

    /**
     * @param $method
     * @param string $url
     * @param array  $params url query parameters
     * @param array $body  request body
     * @param array $headers request
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function send($method, $url, array $params=[], array $body =[], array $headers = [])
    {
        $options=[];
        $options['query'] = $params;
        $options['headers'] = $headers;
        $res = $this->lib->request($method,$url, $options);

        return $res;
    }

    /**
     * @param $api
     * @param array $params
     * @return \Psr\Http\Message\StreamInterface
     */
    public function get($api, $params = [])
    {
        $response = $this->send("GET", $api, $params);

        return $response->getBody();
    }

    /**
     * @param $api
     * @param array $body
     * @param array $headers
     * @param array $params
     * @return \Psr\Http\Message\StreamInterface
     */
    public function post($api, $body = [], $headers = [], $params = [])
    {
        $response = $this->send("POST", $api, $params, $body, $headers);

        return $response->getBody();
    }
}