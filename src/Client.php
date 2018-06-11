<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 4:48 PM
 */

namespace GetMiked\UntappdSDK;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;

class UntappdClient {

    /**
     * @var string
     */
    protected $url;

    /**
     * @var string
     */
    protected $authKey;

    /**
     * @var array
     */
    protected $requestOptions;

    /**
     * @var Client $http_client
     */
    private $http_client;

    /**
     * @var int[] $rateLimitDetails
     */
    protected $rateLimitDetails = [];


    /**
     * UntappdClient constructor.
     * @param null $url
     * @param null $authKey
     * @param array $requestOptions
     */
    public function __construct($url = null,$authKey = null,$requestOptions = []){

        $this->setDefaultClient();


        if ($url) {
            $this->url = $url;
        }

        if ($authKey) {
            $this->authKey = $authKey;
        }

        if ($requestOptions) {
            $this->requestOptions = $requestOptions;
        }

    }

    /**
     *
     */
    private function setDefaultClient()
    {
        $this->http_client = new Client();
    }

    /**
     * Sets GuzzleHttp client.
     *
     * @param Client $client
     */
    public function setClient($client)
    {
        $this->http_client = $client;
    }

    /**
     * @param Response $response
     * @throws \Exception
     */
    private function setRateLimitDetails(Response $response)
    {
        $this->rateLimitDetails = [
            'limit' => $response->hasHeader('X-RateLimit-Limit')
                ? (int)$response->getHeader('X-RateLimit-Limit')[0]
                : null,
            'remaining' => $response->hasHeader('X-RateLimit-Remaining')
                ? (int)$response->getHeader('X-RateLimit-Remaining')[0]
                : null,
            'reset_at' => $response->hasHeader('X-RateLimit-Reset')
                ? (new \DateTimeImmutable())->setTimestamp((int)$response->getHeader('X-RateLimit-Reset')[0])
                : null,
        ];
    }

    /**
     * @param Response $response
     * @return mixed
     * @throws \Exception
     */
    private function handleResponse(Response $response)
    {
        $this->setRateLimitDetails($response);
        $stream = \GuzzleHttp\Psr7\stream_for($response->getBody());
        $data = json_decode($stream);
        return $data;
    }

    public function getRequestOptions($defaultGuzzleRequestOptions = [])
    {
        return array_replace_recursive($this->requestOptions, $defaultGuzzleRequestOptions);
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get()
    {
        $requestOptions = $this->getRequestOptions(
            [

            ]
        );

        try{
            $response = $this->http_client->request('GET',"",$requestOptions);
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }

    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put()
    {
        $requestOptions = $this->getRequestOptions(
            [

            ]
        );

        try{
        $response = $this->http_client->request('PUT',"",$requestOptions);
        return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post()
    {
        $requestOptions = $this->getRequestOptions(
            [

            ]
        );

        try{
        $response = $this->http_client->request('POST',"",$requestOptions);
        return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch()
    {
        $requestOptions = $this->getRequestOptions(
            [

            ]
        );

        try{
        $response = $this->http_client->request('PATCH',"",$requestOptions);
        return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }


    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete()
    {
        $requestOptions = $this->getRequestOptions(
            [

            ]
        );

        try{
        $response = $this->http_client->request('DELETE',"",$requestOptions);
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }
    }
}