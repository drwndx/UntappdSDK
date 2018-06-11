<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 8:56 PM
 */

namespace GetMiked\UntappdSDK;


class ContainerSizes
{
    /**
     * @var UntappdClient
     */
    private $client;

    /**
     * ContainerSizes constructor.
     * @param UntappdClient $client
     */
    public function __construct($client)
    {
        $this->client= $client;
    }

    /**
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#container-sizes
     */
    public function getContainerSizes(){
        return $this->client->get("container_sizes");
    }
}