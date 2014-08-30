<?php
/**
 * ProcessorInterface.php
 * Definition of interface ProcessorInterface
 * 
 * Created 30-Aug-2014 17:12:51
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * @copyright (c) 2014, Byng Systems Ltd
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
     * @param array $rawData
     * @return object
     */
    public function processRawData(array $rawData);
    
}
