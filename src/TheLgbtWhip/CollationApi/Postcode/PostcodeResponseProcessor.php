<?php
/**
 * PostcodeResponseProcessor.php
 * Definition of class PostcodeResponseProcessor
 * 
 * Created 30-Aug-2014 17:19:03
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi\Postcode;

use TheLgbtWhip\CollationApi\ProcessorInterface;



/**
 * PostcodeResponseProcessor
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 */
class PostcodeResponseProcessor implements ProcessorInterface
{
    
    /**
     * 
     */
    const AREAS_KEY = 'areas';
    
    /**
     * 
     */
    const TYPE_NAME_KEY = 'type_name';
    
    /**
     *
     * @var string
     */
    protected $targetTypeName;
    
    
    
    /**
     * 
     * @param string $targetTypeName
     */
    public function __construct($targetTypeName)
    {
        $this->targetTypeName = $targetTypeName;
    }
    
    /**
     * 
     * @param array $rawData
     * @return object|null
     */
    public function processRawData(array $rawData)
    {
        if (
            isset($rawData[self::AREAS_KEY])
            && ($targetData = $this->findArea($rawData[self::AREAS_KEY])) !==  null
        ) {
            return (object) $targetData;
        }
        
        return null;
    }
    
    /**
     * 
     * @param array $areas
     * @return array|null
     */
    protected function findArea(array $areas)
    {
        foreach ($areas as $area) {
            if (
                isset($area[self::TYPE_NAME_KEY])
                && $area[self::TYPE_NAME_KEY] === $this->targetTypeName
            ) {
                return $area;
            }
        }
        
        return null;
    }

}
