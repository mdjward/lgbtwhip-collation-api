<?php
/**
 * AbstractApiKeyClient.php
 * Definition of class AbstractApiKeyClient
 * 
 * Created 30-Aug-2014 23:26:19
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi;

use Guzzle\Http\Client;



/**
 * AbstractApiKeyClient
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
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
