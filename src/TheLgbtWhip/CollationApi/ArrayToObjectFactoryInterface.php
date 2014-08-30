<?php
/**
 * ArrayToObjectFactoryInterface.php
 * Definition of interface ArrayToObjectFactoryInterface
 * 
 * Created 30-Aug-2014 19:39:50
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi;



/**
 * ArrayToObjectFactoryInterface
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
interface ArrayToObjectFactoryInterface
{
    
    /**
     * 
     * @param array $data
     * @return object
     */
    public function build(array $data);
    
}
