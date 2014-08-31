<?php
/**
 * NotInOfficeException.php
 * Definition of class NotInOfficeException
 * 
 * Created 31-Aug-2014 02:56:50
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * @copyright (c) 2014, Byng Systems Ltd
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use DateTime;
use Exception;



/**
 * NotInOfficeException
 * 
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 */
class NotInOfficeException extends Exception
{
    
    /**
     *
     * @var MemberOfParliament
     */
    protected $mp;
    
    /**
     *
     * @var DateTime
     */
    protected $dateOfVote;
    
    
    
    /**
     * 
     * @param \TheLgbtWhip\CollationApi\Candidate\MemberOfParliament $mp
     * @param DateTime $dateOfVote
     */
    public function __construct(MemberOfParliament $mp, DateTime $dateOfVote)
    {
        parent::__construct(
            sprintf(
                "%s was not in office on the date of the vote (%s)",
                $mp["name"],
                $dateOfVote->format("d/m/Y")
            ),
            null,
            null
        );
            
        $this->mp = $mp;
        $this->dateOfVote = $dateOfVote;
    }
    
    public function getMp()
    {
        return $this->mp;
    }

    public function getDateOfVote()
    {
        return $this->dateOfVote;
    }
    
}
