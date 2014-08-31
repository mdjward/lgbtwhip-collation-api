<?php
/**
 * MemberOfParliament.php
 * Definition of class MemberOfParliament
 * 
 * Created 31-Aug-2014 02:13:24
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use ArrayAccess;



/**
 * MemberOfParliament
 * Todo: refactor into a more sensible form
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class MemberOfParliament implements ArrayAccess
{
    
    /**
     *
     * @var array
     */
    protected $rawData;

    
    
    /**
     * 
     * @param array $rawData
     */
    public function __construct(array $rawData = [])
    {
        $this->rawData = $rawData;
    }
    
    /**
     * 
     * @return array
     */
    public function toArray()
    {
        return $this->rawData;
    }
    
    /**
     * 
     * @param string|integer $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->rawData[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->rawData[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->rawData[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->rawData[$offset]);
    }

}
