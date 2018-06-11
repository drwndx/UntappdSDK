<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 4:48 PM
 */



namespace GetMiked\UntappdSDK;

require __DIR__ . '\..\vendor\autoload.php';

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
     * @var string
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
     * @var ContainerSizes $containerSizes
     */
    public $containerSizes;

    /**
     * @var Containers $containers
     */
    public $containers;

    /**
     * UntappdClient constructor.
     * @param null $url
     * @param null $authKey
     * @param array $requestOptions
     */
    public function __construct($url = null,$authKey = null,$requestOptions = []){

        $this->setDefaultClient();
        $this->containerSizes = new ContainerSizes($this);
        $this->containers = new Containers($this);


        if ($url) {
            $this->url = $url;
        }

        if ($authKey) {
            $this->authKey = $authKey;
        }


            $this->requestOptions = $requestOptions;


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

    public function getRequestOptions($defaultRequestOptions = [])
    {
        return array_replace_recursive($this->requestOptions, $defaultRequestOptions);
    }

    /**
     * @param $endpoint
     * @param null $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get($endpoint,$options = null)
    {
        $requestOptions = $this->getRequestOptions(
            [
                'headers' => [
                    'Authorization' => 'Basic '. $this->authKey ,

                ],
            ]
        );
        if ($options) $requestOptions['headers'] = $this->getRequestOptions($options);

        try{
            $response = $this->http_client->request('GET',"$this->url$endpoint",$requestOptions);
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }

    }

    /**
     * @param $endpoint
     * @param null $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function put($endpoint,$options = null)
    {
        $requestOptions = $this->getRequestOptions(
            [
                'headers' => [
                    'Authorization' => 'Basic '. $this->authKey ,

                ],
            ]
        );
        if ($options) $requestOptions['headers'] = $this->getRequestOptions($options);

        try{
        $response = $this->http_client->request('PUT',"$this->url$endpoint",$requestOptions);
        return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }
    }

    /**
     * @param $endpoint
     * @param null $options
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function post($endpoint,$options = null)
    {
        $requestOptions = $this->getRequestOptions(
            [
                'headers' => [
                    'Authorization' => 'Basic '. $this->authKey ,

                ],
            ]
        );
        if ($options) $requestOptions['headers'] = $this->getRequestOptions($options);

        try{
        $response = $this->http_client->request('POST',"$this->url$endpoint",$requestOptions);
        return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }
    }

    /**
     * @param $endpoint
     * @param null $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function patch($endpoint,$options = null)
    {
        $requestOptions = $this->getRequestOptions(
            [
                'headers' => [
                    'Authorization' => 'Basic '. $this->authKey ,

                ],
            ]
        );
        if ($options) $requestOptions['headers'] = $this->getRequestOptions($options);

        try{
        $response = $this->http_client->request('PATCH',"$this->url$endpoint",$requestOptions);
        return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }


    }

    /**
     * @param $endpoint
     * @param null $options
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete($endpoint,$options = null)
    {
        $requestOptions = $this->getRequestOptions(
            [
                'headers' => [
                    'Authorization' => 'Basic '. $this->authKey ,

                ],
            ]
        );
        if ($options) $requestOptions['headers'] = $this->getRequestOptions($options);

        try{
        $response = $this->http_client->request('DELETE',"$this->url$endpoint",$requestOptions);
            return $this->handleResponse($response);
        } catch (\Exception $e) {
            echo ($e->getMessage() . "\n");
        }
    }
}