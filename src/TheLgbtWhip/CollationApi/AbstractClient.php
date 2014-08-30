<?php
/**
 * AbstractClient.php
 * Definition of class AbstractClient
 * 
 * Created 30-Aug-2014 17:22:30
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi;

use Guzzle\Http\Client;



/**
 * AbstractClient
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
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
     */
    public function __construct(Client $client, ProcessorInterface $processor)
    {
        $this->client = $client;
    }
    
}
