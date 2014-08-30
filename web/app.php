<?php
/**
 * app.php
 * 
 * Created 30-Aug-2014 17:17:11
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */

require_once __DIR__ . "/../injection.php";

use Slim\Slim;



$app = new Slim();

$app->get(
    "/postcode/:postcode",
    function($postcode) use ($app, $postcodeClient) {
        echo json_encode($postcodeClient->getConstituencyForPostcode($postcode));
        
        $app->response->headers->set("Content-Type", "text/json");
    }
);

$app->run();
