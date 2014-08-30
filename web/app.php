<?php
/**
 * app.php
 * 
 * Created 30-Aug-2014 17:17:11
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * @copyright (c) 2014, Byng Systems Ltd
 */

require_once __DIR__ . "/../injection.php";

use Slim\Slim;



// Initialise app and inject common services
$app = new Slim([
    
]);

// Set default content-type header (this is an application constant)
$app->response->headers->set("Content-Type", "text/json");

// Postcode route
$app->get(
    "/postcode/:postcode",
    function($postcode) use ($app, $postcodeClient) {
        if (($constituency = $postcodeClient->getConstituencyForPostcode($postcode)) !== null) {
            return print json_encode($constituency);
        }
    
        $app->response->setStatus(404);
    }
);

$app->run();

