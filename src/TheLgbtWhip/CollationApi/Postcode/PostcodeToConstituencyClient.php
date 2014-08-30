<?php
/**
 * PostcodeToConstituencyClient.php
 * Definition of class PostcodeToConstituencyClient
 * 
 * Created 30-Aug-2014 17:34:32
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Postcode;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Url;
use TheLgbtWhip\CollationApi\AbstractClient;



/**
 * PostcodeToConstituencyClient
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class PostcodeToConstituencyClient extends AbstractClient
{
    
    /**
     *
     * @var type 
     */
    protected $baseUrl;
    
    /**
     * 
     * @param Client $client
     * @param PostcodeResponseProcessor $processor
     * @param string $baseUrl
     */
    public function __construct(
        Client $client,
        PostcodeResponseProcessor $processor,
        $baseUrl
    ) {
        parent::__construct($client, $processor);
        
        $this->baseUrl = $baseUrl;
    }
    
    public function getConstituencyForPostcode($postcode)
    {
        $url = Url::factory($this->baseUrl);
        $url->setPath($url->getPath() . '/' . $postcode);
        
        $request = $this->client->get((string) $url);

        try {
            $response = $request->send();
            
            return $this->processor->processRawData(
                json_decode($response->getBody(true), true)
            );
        } catch (ClientErrorResponseException $ex) {
            throw $ex;
        }
    }
    
}
