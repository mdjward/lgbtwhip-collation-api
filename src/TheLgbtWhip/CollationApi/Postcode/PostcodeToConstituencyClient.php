<?php
/**
 * PostcodeToConstituencyClient.php
 * Definition of class PostcodeToConstituencyClient
 * 
 * Created 30-Aug-2014 17:34:32
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi\Processor;

use Guzzle\Http\Client;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Guzzle\Http\Url;
use TheLgbtWhip\CollationApi\AbstractClient;



/**
 * PostcodeToConstituencyClient
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
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
        $url->setFragment($url->getFragment() . '/' . $postcode);
        
        $request = $this->client->get((string) $url);

        try {
            return $this->processor->processRawData(
                json_decode($request->send(), true)
            );
        } catch (ClientErrorResponseException $ex) {
            throw $ex;
        }
    }
    
}
