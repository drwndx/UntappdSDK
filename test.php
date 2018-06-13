<?php
/**
 * Created by PhpStorm.
 * User: drwnd
 * Date: 6/10/2018
 * Time: 9:21 PM
 */

require_once __DIR__ . '\src\Client.php';

use GetMiked\UntappdSDK\UntappdClient;

$client = new UntappdClient("https://business.untappd.com/api/v1/","");

/**
 *
 */
//print_r($client->containerSizes->getContainers());

/**
 *
 */
//print_r($client->containers->getContainers('200'));

//print_r($client->containers->createContainer("1","17","5.00"));

print_r($client->containers->updateContainer("1","17","5.00", "2"));
