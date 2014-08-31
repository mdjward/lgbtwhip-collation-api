<?php
/**
 * MemberOfParliamentResponseProcessor.php
 * Definition of class MemberOfParliamentResponseProcessor
 * 
 * Created 30-Aug-2014 23:18:37
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use ICanBoogie\Inflector;
use TheLgbtWhip\CollationApi\ProcessorInterface;



/**
 * MemberOfParliamentResponseProcessor
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class MemberOfParliamentResponseProcessor implements ProcessorInterface
{
    
    /**
     * 
     */
    const KEY_FIRST_NAME = "firstName";
    
    /**
     * 
     */
    const KEY_LAST_NAME = "lastName";
    
    /**
     *
     * @var Inflector
     */
    protected $inflector;
    
    /**
     * 
     * @param Inflector $inflector
     */
    public function __construct(Inflector $inflector)
    {
        $this->inflector = $inflector;
    }
    
    /**
     * 
     * @param mixed $rawData
     * @return type
     */
    public function processRawData($rawData)
    {
        $convertedArray = [];
        
        foreach ($rawData as $key => $value) {
            $convertedArray[$this->inflector->camelize($key, true)] = $value;
        }
        
        return $convertedArray;
    }
    
    public function processRawDataWithFilter($rawData, $name)
    {
        $processedData = $this->processRawData($rawData);
        
        if (isset($processedData[self::KEY_FIRST_NAME]) && isset($processedData[self::KEY_LAST_NAME])) {
            $processedName = $processedData[self::KEY_FIRST_NAME] . " " . $processedData[self::KEY_LAST_NAME];
            
            if ($processedName === $name) {
                $processedData["name"] = $name;
                
                return new MemberOfParliament($processedData);
            }
        }
        
        return null;
    }

}
