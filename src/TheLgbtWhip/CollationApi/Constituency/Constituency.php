<?php
/**
 * Constituency.php
 * Definition of class Constituency
 * 
 * Created 30-Aug-2014 18:52:22
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * 
 */
namespace TheLgbtWhip\CollationApi\Constituency;

use InvalidArgumentException;



/**
 * Constituency
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 */
class Constituency
{
    
    /**
     * 
     * @var integer
     */
    protected $id;
    
    /**
     *
     * @var string
     */
    protected $name;
    
    /**
     *
     * @var string
     */
    protected $type;
    
    /**
     *
     * @var string
     */
    protected $typeName;
    
    
    
    public function getId()
    {
        return $this->id;
    }

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

    public function setId($id)
    {
        if (!is_numeric($id) || ($id = (int) $id) <= 0) {
            throw new InvalidArgumentException("Invalid constituency ID; must be an integer value greater than 0");
        }
        
        $this->id = $id;
        
        return $this;
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
