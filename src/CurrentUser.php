<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 11:58 PM
 */

namespace GetMiked\UntappdSDK;

/**
 * Class CurrentUser
 * @package GetMiked\UntappdSDK
 *
 * https://docs.business.untappd.com/#current-user
 *
 */
class CurrentUser
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
     * https://docs.business.untappd.com/#current-user
     *
     */
    public function getCurrentUser(){
        return $this->client->get("current_user");
    }

}