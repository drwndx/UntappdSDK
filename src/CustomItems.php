<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/11/2018
 * Time: 12:30 AM
 */

namespace GetMiked\UntappdSDK;

/**
 * Class CustomItems
 * @package GetMiked\UntappdSDK
 *
 * https://docs.business.untappd.com/#custom-items
 *
 */
class CustomItems
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
     * @param $customSectionId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#list-all-custom-items
     *
     */
    public function listCustomItems($customSectionId){
        return $this->client->get("custom_sections/$customSectionId/custom_items");
    }

    /**
     * @param $customSectionId
     * @param $name
     * @param $description
     * @param $customItemTypeId
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#create-a-custom-item
     *
     */
    public function createCustomItem($customSectionId, $name, $description, $customItemTypeId){
        $options = [
            'Content-type' => 'application/json',
            '{
                "custom_item" => {
                    "name" => "' . $name . '",
                    "description" => "' . $description . '",
                    "custom_item_type_id" => ' . $customItemTypeId . ',
                }
            }'
        ];
        return $this->client->post("custom_sections/$customSectionId/custom_items",$options);
    }

    /**
     * @param $customItemId
     * @param null $name
     * @param null $description
     * @param null $customItemTypeId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#retrieve-a-custom-item
     *
     */
    public function retrieveCustomItem($customItemId, $name = null, $description = null, $customItemTypeId = null){
        if ( $name || $description || $customItemTypeId){
            $options = [
                'Content-type' => 'application/json',
                '{
                    "container" => {
                        '. ($name ? ' "name" => "' . $name . '", ' : '') .'
                        '. ($description ? ' "description" => "' . $description . '", ' : '') .'
                        '. ($customItemTypeId ? ' "custom_item_type_id" => ' . $customItemTypeId . ', ' : '') .'
                    }
                }'
            ];

            return $this->client->get("custom_items/$customItemId", $options);
        } else {
            return $this->client->get("custom_items/$customItemId");
        }
    }

    /**
     * @param $customItemId
     * @param null $name
     * @param null $description
     * @param null $customItemTypeId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#update-a-custom-item
     *
     */
    public function updateCustomItem($customItemId, $name = null, $description = null, $customItemTypeId = null){
        if ($name && $description && $customItemTypeId ){
            $options = [
                'Content-type' => 'application/json',
                '{
                    "custom_item" => {
                        "name" => "' . $name . '",
                        "description" => "' . $description . '"",
                        "custom_item_type_id" => ' . $customItemTypeId . '
                    }
                }'
            ];

            return $this->client->put("custom_items/$customItemId",$options);
        } else {
            $options = [
                'Content-type' => 'application/json',
                '{
                    "custom_item" => {
                        '. ($name ? ' "name" => "' . $name . '", ' : '') .'
                        '. ($description ? ' "description" => "' . $description . '"", ' : '') .'
                        '. ($customItemTypeId ? ' "custom_item_type_id" => ' . $customItemTypeId . ', ' : '') .'
                    }
                }'
            ];

            return $this->client->patch("custom_items/$customItemId",$options);
        }
    }

    /**
     * @param $customItemId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#delete-a-custom-item
     *
     */
    public function deleteCustomItem($customItemId){
        return $this->client->delete("custom_items/$customItemId");
    }

    /**
     * @param $customSectionId
     * @param $customItems
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#update-custom-item-positions
     *
     */
    public function updateCustomItemPositions($customSectionId, $customItems){
        $options = [
            'Content-type' => 'application/json',
            '{
                "custom_items" => {
                }
            }'
        ];

        /**
         * TODO update customItems with a for loop
         */
        $options[0]["custom_items"] = $customItems;

        return $this->client->patch("custom_sections/$customSectionId/custom_items/positions",$options);
    }

    /**
     * @param $customItemId
     * @param $customSectionId
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#move-a-custom-item-to-another-custom-section
     *
     */
    public function moveCustomItemSection($customItemId, $customSectionId){
        $options = [
            'Content-type' => 'application/json',
            '{
                "custom_items" => {
                    "custom_section_id" => ' . $customSectionId . '
                }
            }'
        ];
        return $this->client->patch("custom_items/$customItemId/move",$options);
    }
}