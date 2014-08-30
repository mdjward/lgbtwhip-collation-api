<?php
/**
 * Constituency.php
 * Definition of class Constituency
 * 
 * Created 30-Aug-2014 18:52:22
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Constituency;

use InvalidArgumentException;
use JMS\Serializer\Annotation\Accessor;



/**
 * Constituency
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class Constituency
{
    
    /**
     *
     * @var string
     * @Accessor(getter="getName", setter="setName")
     */
    protected $name;
    
    /**
     * 
     * @var string
     * @Accessor(getter="getType", setter="setType")
     */
    protected $type;
    
    /**
     *
     * @var string
     * @Accessor(getter="getTypeName", setter="setTypeName")
     */
    protected $typeName;
    
    
    
    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTypeName()
    {
        return $this->typeName;
    }

    public function setName($name)
    {
        if (!is_string($name) || empty($name)) {
            throw new InvalidArgumentException("Invalid constituency name; must be a non-empty string");
        }
        
        $this->name = $name;
        
        return $this;
    }

    public function setType($type)
    {
        $this->type = (!empty($type) ? $type : null);
        
        return $this;
    }

    public function setTypeName($typeName)
    {
        $this->typeName = (!empty($typeName) ? $typeName : null);
        
        return $this;
    }


}
