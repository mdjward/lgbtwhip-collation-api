<?php
/**
 * ConstituencyFactory.php
 * Definition of class ConstituencyFactory
 * 
 * Created 30-Aug-2014 19:39:03
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * 
 */
namespace TheLgbtWhip\CollationApi\Constituency;

use TheLgbtWhip\CollationApi\ArrayToObjectFactoryInterface;



/**
 * ConstituencyFactory
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 */
class ConstituencyFactory implements ArrayToObjectFactoryInterface
{
    
    /**
     * 
     */
    const KEY_ID = "id";
    
    /**
     * 
     */
    const KEY_NAME = "name";
    
    /**
     * 
     */
    const KEY_TYPE = "type";
    
    /**
     * 
     */
    const KEY_TYPE_NAME = "type_name";
    
    
    
    /**
     * 
     * @param array $data
     * @return Constituency
     */
    public function build(array $data)
    {
        $constituency = new Constituency();
        
        $constituency
            ->setId($data[self::KEY_ID])
            ->setName($data[self::KEY_NAME])
            ->setType($data[self::KEY_TYPE])
            ->setTypeName($data[self::KEY_TYPE_NAME])
        ;
        
        return $constituency;
    }

}
