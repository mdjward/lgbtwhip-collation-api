<?php
/**
 * injection.php
 * Rudimentary dependency injection wiring
 * 
 * Created 30-Aug-2014 17:51:00
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * @copyright (c) 2014, Byng Systems Ltd
 */

require_once __DIR__ . "/vendor/autoload.php";

use Guzzle\Http\Client;
use Symfony\Component\Yaml\Parser;
use TheLgbtWhip\CollationApi\Postcode\PostcodeResponseProcessor;
use TheLgbtWhip\CollationApi\Postcode\PostcodeToConstituencyClient;



$configurationParser = new Parser();
$configuration = $configurationParser->parse(
    file_get_contents(__DIR__ . "/config.yml")
);



// Initialise common client
$client = new Client();

// Initialise postcode to constituency processing artifacts
$postcodeProcessor = new PostcodeResponseProcessor(
    $configuration["postcode"]["processor"]["target_type_name"]
);
$postcodeClient = new PostcodeToConstituencyClient(
    $client,
    $postcodeProcessor,
    $configuration["postcode"]["client"]["base_url"]
);
