<?php
/**
 * ProcessorInterface.php
 * Definition of interface ProcessorInterface
 * 
 * Created 30-Aug-2014 17:12:51
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi;



/**
 * ProcessorInterface
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
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
