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
        } catch (Exception $ex) {
            throw $ex;
        }
    
        $app->response->setStatus(404);
        return print json_encode([
            'message' => "Could not find constituency for that postcode"
        ]);
    }
);

// MP route
$app->get(
    "/mp",
    function() use ($app, $votingClient) {
        $name = $app->request->get("name");
        $constituency = $app->request->get("constituency");
        
        if ($name === null || $constituency === null) {
            $app->response->setStatus(401);
            
            return print json_encode([
                'message' => "Both candidate name constituency must be provided as query string parameters 'name' and 'constituency' respectively"
            ]);
        }
        
        try {
            if (($mp = $votingClient->getCandidateWithVotingRecord($name, $constituency))) {
                return print json_encode($mp);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
        
        $app->response->setStatus(404);
        return print json_encode([
            'message' => "Could not match MP with that name and constituency"
        ]);
    }
);

$app->get(
    "/server-dump",
    function() {
        return print json_encode($_SERVER);
    }
);

$app->run();
