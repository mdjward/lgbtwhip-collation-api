<?php
/**
 * CandidateVotingRecordProcessor.php
 * Definition of class CandidateVotingRecordProcessor
 * 
 * Created 30-Aug-2014 19:14:49
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use DateTime;
use TheLgbtWhip\CollationApi\Candidate\Parser\ThePublicWhipParser;
use TheLgbtWhip\CollationApi\ProcessorInterface;



/**
 * CandidateVotingRecordProcessor
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class CandidateVotingRecordProcessor implements ProcessorInterface
{
    /**
     *
     * @var ThePublicWhipParser
     */
    protected $thePublicWhipParser;
    
    
    
    /**
     * 
     * @param ThePublicWhipParser $thePublicWhipParser
     */
    public function __construct(ThePublicWhipParser $thePublicWhipParser)
    {
        $this->thePublicWhipParser = $thePublicWhipParser;
    }
    
    public function processRawData($rawData)
    {
        if (!is_string($rawData)) {
            return null;
        }
        
        return $this->thePublicWhipParser->parse($rawData);
    }
    
    public function processRawCandidateData($rawData, MemberOfParliament $mp, DateTime $dateOfVote)
    {
        /* @var $termStartDate DateTime */
        $termStartDate = DateTime::createFromFormat("Y-m-d", $mp["enteredHouse"]);
        $termStartDate->setTime(0, 0, 0);
        
        if ($termStartDate > $dateOfVote) {
            throw new NotInOfficeException($mp, $dateOfVote);
        }

        $name = $mp["name"];
        $data = $this->processRawData($rawData);
            
        if (isset($data[$name])) {
            return $data[$name];
        }
        
        return null;
    }
    
}
