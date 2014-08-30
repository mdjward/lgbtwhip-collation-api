<?php
/**
 * AbstractClient.php
 * Definition of class AbstractClient
 * 
 * Created 30-Aug-2014 17:22:30
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi;

use Guzzle\Http\Client;



/**
 * AbstractClient
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
abstract class AbstractClient
{
    
    /**
     *
     * @var Client
     */
    protected $client;
    
    /**
     *
     * @var ProcessorInterface
     */
    protected $processor;
    
    /**
     * 
     * @param Client $client
     * @param ProcessorInterface $processor
     */
    public function __construct(Client $client, ProcessorInterface $processor)
    {
        $this->client = $client;
        $this->processor = $processor;
    }
    
}
