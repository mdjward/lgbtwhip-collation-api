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

// MP route
$app->get(
    "/mp",
    function() use ($app, $mpClient) {
        $name = $app->request->get("name");
        $constituency = $app->request->get("constituency");
        
        if ($name === null || $constituency === null) {
            $app->response->setStatus(401);
            return print "{'message': 'Both candidate name 'name' and constituency 'constituency' must be provided as GET parameters'}";
        }
        
        try {
            if (($mp = $mpClient->getMemberOfParliament($name, $constituency))) {
                return print json_encode($mp);
            }
        } catch (Exception $ex) {}
        
        $app->response->setStatus(404);
        return print "{'message': 'Could not match MP with that name and constituency'}";
    }
);

$app->run();

