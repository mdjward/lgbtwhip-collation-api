<?php
/**
 * AbstractApiKeyClient.php
 * Definition of class AbstractApiKeyClient
 * 
 * Created 30-Aug-2014 23:26:19
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi;

use Guzzle\Http\Client;



/**
 * AbstractApiKeyClient
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class AbstractApiKeyClient extends AbstractClient
{
    /**
     *
     * @var string
     */
    protected $apiKey;
    
    
    
    /**
     * 
     * @param Client $client
     * @param ProcessorInterface $processor
     * @param string $baseUrl
     * @param string $apiKey
     */
    public function __construct(
        Client $client,
        ProcessorInterface $processor,
        $baseUrl,
        $apiKey
    ) {
        parent::__construct($client, $processor, $baseUrl);
        
        $this->apiKey = $apiKey;
    }
    
}
