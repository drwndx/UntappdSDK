<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/11/2018
 * Time: 12:27 AM
 */

namespace GetMiked\UntappdSDK;

/**
 * Class CustomItemTypes
 * @package GetMiked\UntappdSDK
 *
 * https://docs.business.untappd.com/#custom-item-types
 *
 */
class CustomItemTypes
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
     * https://docs.business.untappd.com/#list-all-custom-item-types
     *
     */
    public function listCustomItemTypes(){
        return $this->client->get("custom_item_types");
    }
}