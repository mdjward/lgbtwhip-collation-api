<?php
/**
 * MemberOfParliamentClient.php
 * Definition of class MemberOfParliamentClient
 * 
 * Created 30-Aug-2014 23:13:27
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use Guzzle\Http\Client;
use Guzzle\Http\Url;
use TheLgbtWhip\CollationApi\AbstractApiKeyClient;
use TheLgbtWhip\CollationApi\ProcessorInterface;



/**
 * MemberOfParliamentClient
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 */
class MemberOfParliamentClient extends AbstractApiKeyClient
{
    
    public function __construct(
        Client $client,
        ProcessorInterface $processor,
        $baseUrl,
        $apiKey
    ) {
        parent::__construct($client, $processor, $baseUrl, $apiKey);
    }
    
    public function getMemberOfParliament($name, $constituency)
    {
        $url = Url::factory($this->baseUrl);
        
        $query = $url->getQuery();
        
        $query->add("key", $this->apiKey);
        $query->add("constituency", $constituency);
        
        $request = $this->client->get((string) $url);
        $response = $request->send();
        
        return $this->processor->processRawDataWithFilter(
            $response->json(),
            $name
        );
    }
    
}
