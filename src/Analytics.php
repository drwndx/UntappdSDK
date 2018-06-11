<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 11:54 PM
 */

namespace GetMiked\UntappdSDK;


class Analytics
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
     * @param $locationId
     * @param $sourceName
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * https://docs.business.untappd.com/#track-an-event
     *
     */
    public function trackEvent($locationId,$sourceName){
        return $this->client->get("locations/$locationId/analytics?source_name=$sourceName");
    }
}