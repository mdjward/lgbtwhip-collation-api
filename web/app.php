<?php
/**
 * app.php
 * 
 * Created 30-Aug-2014 17:17:11
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */

require_once __DIR__ . "/../injection.php";

use Slim\Slim;



// Initialise app and inject common services
$app = new Slim([
    "serializer" => $serializer
]);

// Set default content-type header (this is an application constant)
$app->response->headers->set("Content-Type", "text/json");

// Postcode route
$app->get(
    "/postcode/:postcode",
    function($postcode) use ($app, $serializer, $postcodeClient) {
        try {
            if (($constituency = $postcodeClient->getConstituencyForPostcode($postcode)) !== null) {
                return print $serializer->serialize($constituency, "json");
            }
        } catch (Exception $ex) {}
    
        $app->response->setStatus(404);
        return print "{'message': 'Could not find constituency for that postcode'}";
    }
);

$app->run();

