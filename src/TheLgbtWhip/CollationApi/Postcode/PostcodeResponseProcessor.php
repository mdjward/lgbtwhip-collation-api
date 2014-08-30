<?php
/**
 * PostcodeResponseProcessor.php
 * Definition of class PostcodeResponseProcessor
 * 
 * Created 30-Aug-2014 17:19:03
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi\Postcode;

use TheLgbtWhip\CollationApi\Constituency\ConstituencyFactory;
use TheLgbtWhip\CollationApi\ProcessorInterface;



/**
 * PostcodeResponseProcessor
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class PostcodeResponseProcessor implements ProcessorInterface
{
    
    /**
     * 
     */
    const SHORTCUTS_KEY = "shortcuts";
    
    /**
     * 
     */
    const PARLIAMENT_SHORTCUT_KEY = "WMC";
    
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
     * @var ConstituencyFactory
     */
    protected $constituencyFactory;
    
    /**
     *
     * @var string
     */
    protected $targetTypeName;
    
    
    
    /**
     * 
     * @param ConstituencyFactory $constituencyFactory
     * @param string $targetTypeName
     */
    public function __construct(
        ConstituencyFactory $constituencyFactory,
        $targetTypeName
    ) {
        $this->constituencyFactory = $constituencyFactory;
        $this->targetTypeName = $targetTypeName;
    }
    
    /**
     * 
     * @param array $rawData
     * @return object|null
     */
    public function processRawData(array $rawData)
    {
        // The lack of the areas means we have no data
        if (!isset($rawData[self::AREAS_KEY])) {
            return null;
        }
        
        $areas = $rawData[self::AREAS_KEY];
        
        if (
            (
                ($shortcut = $this->getShortcut($rawData)) !== null
                && ($targetData = $this->getAreaByShortcut($shortcut, $areas)) !== null
            )
            || ($targetData = $this->findArea($rawData[self::AREAS_KEY])) !==  null
        ) {
            return $this->constituencyFactory->build($targetData);
        }
        
        return null;
    }
    
    protected function getShortcut(array $rawData)
    {
        if (isset($rawData[self::SHORTCUTS_KEY][self::PARLIAMENT_SHORTCUT_KEY])) {
            return $rawData[self::SHORTCUTS_KEY][self::PARLIAMENT_SHORTCUT_KEY];
        }
        
        return null;
    }
    
    protected function getAreaByShortcut($shortcut, array $areas)
    {
        if (isset($areas[($shortcut = (string) $shortcut)])) {
            return $areas[$shortcut];
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
