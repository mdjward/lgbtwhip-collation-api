<?php
/**
 * injection.php
 * Rudimentary dependency injection wiring
 * 
 * Created 30-Aug-2014 17:51:00
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */

$configuration = require_once(__DIR__ . "/configuration.php");

use Guzzle\Http\Client;
use TheLgbtWhip\CollationApi\Constituency\ConstituencyFactory;
use TheLgbtWhip\CollationApi\Postcode\PostcodeResponseProcessor;
use TheLgbtWhip\CollationApi\Postcode\PostcodeToConstituencyClient;



// Initialise common client
$client = new Client();

// Initialise constituency processing artifacts
$constituencyFactory = new ConstituencyFactory();

// Initialise postcode to constituency processing artifacts
$postcodeProcessor = new PostcodeResponseProcessor(
    $constituencyFactory,
    $configuration["postcode"]["processor"]["target_type_name"]
);
$postcodeClient = new PostcodeToConstituencyClient(
    $client,
    $postcodeProcessor,
    $configuration["postcode"]["client"]["base_url"]
);
