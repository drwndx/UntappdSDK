<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/11/2018
 * Time: 12:06 AM
 */

namespace GetMiked\UntappdSDK;

/**
 * Class CustomContainers
 * @package GetMiked\UntappdSDK
 *
 * https://docs.business.untappd.com/#custom-containers
 *
 */
class CustomContainers
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
     * @param $itemId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#list-all-custom-containers
     *
     */
    public function listCustomContainers($itemId){
        return $this->client->get("custom_items/$itemId/custom_containers");
    }

    /**
     * @param $customItemId
     * @param $name
     * @param $price
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#create-a-custom-container
     *
     */
    public function createCustomContainer($customItemId,$name,$price){
        $options = [
            'Content-type' => 'application/json',
            '{
                "custom_container" => {
                    "name" => "' . $name . '",
                    "price" => ' . $price . '
                }
            }'
        ];
        return $this->client->post("custom_items/$customItemId/custom_containers",$options);
    }

    /**
     * @param $customContainerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#retrieve-a-custom-container
     *
     */
    public function retrieveCustomContainer($customContainerId){
        return $this->client->get("custom_containers/$customContainerId");
    }

    /**
     * @param $customContainerId
     * @param null $name
     * @param null $price
     * @param null $position
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#update-a-custom-container
     *
     */
    public function updateCustomContainer($customContainerId, $name = null, $price = null, $position = null){
        if ($name && $price && $position ){
            $options = [
                'Content-type' => 'application/json',
                '{
                    "custom_container" => {
                        "name" => "' . $name . '",
                        "price" => ' . $price . ',
                        "position" => ' . $position . '
                    }
                }'
            ];

            return $this->client->put("custom_containers/$customContainerId",$options);
        } else {
            $options = [
                'Content-type' => 'application/json',
                '{
                    "custom_container" => {
                        '. ($name ? ' "name" => "' . $name . '", ' : '') .'
                        '. ($price ? ' "price" => ' . $price . ', ' : '') .'
                        '. ($position ? ' "position" => ' . $position . ', ' : '') .'
                    }
                }'
            ];

            return $this->client->patch("custom_containers/$customContainerId",$options);
        }
    }

    /**
     * @param $customContainerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#delete-a-custom-container
     *
     */
    public function deleteCustomContainer($customContainerId){
        return $this->client->delete("custom_containers/$customContainerId");
    }
}