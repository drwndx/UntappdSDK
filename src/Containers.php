<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 9:58 PM
 */

namespace GetMiked\UntappdSDK;


class Containers
{
    /**
     * @var UntappdClient
     */
    private $client;

    /**
     * Containers constructor.
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
     * https://docs.business.untappd.com/#list-all-containers
     *
     */
    public function getContainers($itemId){
        return $this->client->get("items/$itemId/containers");
    }

    /**
     * @param $itemId
     * @param $containerSizeId
     * @param $price
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#create-a-container
     *
     */
    public function createContainer($itemId,$containerSizeId,$price){
        $options = [
            'Content-type' => 'application/json',
            '{
                "container" => {
                    "container_size_id" => ' . $containerSizeId . ',
                    "price" => ' . $price . '
                }
            }'
        ];
        return $this->client->post("items/$itemId/containers",$options);
    }

    /**
     * @param $containerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#retrieve-a-container
     *
     */
    public function retrieveContainer($containerId){
        return $this->client->get("containers/$containerId");
    }

    /**
     * @param $containerId
     * @param null $containerSizeId
     * @param null $price
     * @param null $position
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#update-a-container
     *
     */
    public function updateContainer($containerId, $containerSizeId = null, $price = null, $position = null){
        if ($containerSizeId && $price && $position ){
            $options = [
                'Content-type' => 'application/json',
                '{
                    "container" => {
                        "container_size_id" => ' . $containerSizeId . ',
                        "price" => ' . $price . ',
                        "position" => ' . $position . '
                    }
                }'
            ];

            return $this->client->put("containers/$containerId",$options);
        } else {
            $options = [
                'Content-type' => 'application/json',
                '{
                    "container" => {
                        '. ($containerSizeId ? ' "container_size_id" => ' . $containerSizeId . ', ' : '') .'
                        '. ($price ? ' "price" => ' . $price . ', ' : '') .'
                        '. ($position ? ' "position" => ' . $position . ', ' : '') .'
                    }
                }'
            ];

            return $this->client->patch("containers/$containerId",$options);
        }

    }

    /**
     * @param $containerId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#delete-a-container
     *
     */
    public function deleteContainer($containerId){
        return $this->client->delete("containers/$containerId");
    }

}