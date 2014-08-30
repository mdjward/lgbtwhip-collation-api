<?php
/**
 * ProcessorInterface.php
 * Definition of interface ProcessorInterface
 * 
 * Created 30-Aug-2014 17:12:51
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi;



/**
 * ProcessorInterface
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
interface ProcessorInterface
{
    
    /**
     * 
     * @param mixed $rawData
     * @return object
     */
    public function processRawData($rawData);
    
}
