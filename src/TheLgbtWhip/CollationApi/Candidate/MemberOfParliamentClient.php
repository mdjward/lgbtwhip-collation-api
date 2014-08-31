<?php
/**
 * MemberOfParliamentClient.php
 * Definition of class MemberOfParliamentClient
 * 
 * Created 30-Aug-2014 23:13:27
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use Guzzle\Http\Client;
use Guzzle\Http\Url;
use TheLgbtWhip\CollationApi\AbstractApiKeyClient;
use TheLgbtWhip\CollationApi\ProcessorInterface;



/**
 * MemberOfParliamentClient
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class MemberOfParliamentClient extends AbstractApiKeyClient
{
    
    public function __construct(
        Client $client,
        MemberOfParliamentResponseProcessor $processor,
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
        
        $mp = $this->processor->processRawDataWithFilter(
            $response->json(),
            $name
        );
        
        if ($mp === null) {
            return null;
        }
        
        return $this->getDatesInParliament($mp);
    }
    
    protected function getDatesInParliament(MemberOfParliament $mp)
    {
        $url = Url::factory($this->baseUrl);
        
        $query = $url->getQuery();
        $query->add("key", $this->apiKey);
        $query->add("id", $mp["personId"]);
        
        $request = $this->client->get((string) $url);
        $response = $request->send();
        
        return $this->processor->processMpTermsInParliament(
            $mp,
            $response->json()
        );
    }
    
}
