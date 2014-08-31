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
use ICanBoogie\Inflector;
use JMS\Serializer\Annotation\Accessor;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\SerializerBuilder;
use TheLgbtWhip\CollationApi\Candidate\CandidateVotingRecordClient;
use TheLgbtWhip\CollationApi\Candidate\CandidateVotingRecordProcessor;
use TheLgbtWhip\CollationApi\Candidate\MemberOfParliamentClient;
use TheLgbtWhip\CollationApi\Candidate\MemberOfParliamentResponseProcessor;
use TheLgbtWhip\CollationApi\Candidate\Parser\ThePublicWhipParser;
use TheLgbtWhip\CollationApi\Constituency\ConstituencyFactory;
use TheLgbtWhip\CollationApi\Postcode\PostcodeResponseProcessor;
use TheLgbtWhip\CollationApi\Postcode\PostcodeToConstituencyClient;



// Initialise common client
$client = new Client();

// Initialise common inflector
$inflector = Inflector::get();

// Build JSON serializer by initialising the builder (factory)
$serializerBuilder = new SerializerBuilder();
$serializerBuilder->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy());

// Some strange hackyness required to get annotations working
new Accessor();

// Initialise the serializer
$serializer = $serializerBuilder->build();

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



// Initialise name/constituency to MP processing artifacts
$mpProcessor = new MemberOfParliamentResponseProcessor($inflector);

$mpClient = new MemberOfParliamentClient(
    $client,
    $mpProcessor,
    $configuration["candidate"]["client"]["base_url"],
    $configuration["candidate"]["client"]["apikey"]
);



$thePublicWhipParser = new ThePublicWhipParser();

$votingProcessor = new CandidateVotingRecordProcessor($thePublicWhipParser);

$votingClient = new CandidateVotingRecordClient(
    $client,
    $votingProcessor,
    $mpClient,
    $configuration["voting_records"]["client"]["base_url"],
    $configuration["voting_records"]["relevant_issues"]
);
