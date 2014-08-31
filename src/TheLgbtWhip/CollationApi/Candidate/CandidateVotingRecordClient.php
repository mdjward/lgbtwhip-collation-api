<?php
/**
 * CandidateVotingRecordClient.php
 * Definition of class CandidateVotingRecordClient
 * 
 * Created 30-Aug-2014 19:14:09
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Candidate;

use DateTime;
use Guzzle\Http\Client;
use Guzzle\Http\Url;
use TheLgbtWhip\CollationApi\AbstractClient;



/**
 * CandidateVotingRecordClient
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class CandidateVotingRecordClient extends AbstractClient
{
    
    /**
     *
     * @var MemberOfParliamentClient
     */
    protected $mpClient;
    
    /**
     *
     * @var array
     */
    protected $relevantIssues;
    
    
    
    /**
     * 
     * @param \Guzzle\Http\Client $client
     * @param \TheLgbtWhip\CollationApi\Candidate\CandidateVotingRecordProcessor $processor
     * @param \TheLgbtWhip\CollationApi\Candidate\MemberOfParliamentClient $mpClient
     * @param string $baseUrl
     * @param array $relevantIssues
     */
    public function __construct(
        Client $client,
        CandidateVotingRecordProcessor $processor,
        MemberOfParliamentClient $mpClient,
        $baseUrl,
        array $relevantIssues
    ) {
        parent::__construct($client, $processor, $baseUrl);
        
        $this->mpClient = $mpClient;
        $this->relevantIssues = $relevantIssues;
    }
    
    public function getCandidateWithVotingRecord($name, $constituency)
    {
        if (($mp = $this->mpClient->getMemberOfParliament($name, $constituency)) === null) {
            return null;
        }
        
        $url = Url::factory($this->baseUrl);
        $url->getQuery()->set("display", "allvotes");
        
        $issues = [];
        
        foreach ($this->relevantIssues as $issue) {
            
            $votesForIssue = $this->processIssueForCandidate(
                $url,
                $mp,
                $issue
            );
            
            if (!empty($votesForIssue)) {
                $issues[$issue["name"]] = $votesForIssue;
            }
        }
        
        $mp["votingRecord"] = $issues;
        
        return $mp->toArray();
    }
    
    protected function processIssueForCandidate(
        Url $url,
        MemberOfParliament $mp,
        array $issue
    ) {
        $votes = [];
        
        foreach ($issue["votes"] as $vote) {
            try {
                $votes[$vote["name"]] = ($this->processVoteForCandidate($url, $mp, $vote) ?: 0);
            } catch (NotInOfficeException $ex) {
                // If candidate wasn't in office, they weren't in office
            }
        }
        
        return $votes;
    }
    
    protected function processVoteForCandidate(
        Url $url,
        MemberOfParliament $mp,
        array $vote
    ) {
        $query = $url->getQuery();
        
        $query->set("number", $vote["number"]);
        $query->set("date", $vote["date"]);

        $request = $this->client->get((string) $url);
        $response = $request->send();
        
        $dateOfVote = DateTime::createFromFormat("Y-m-d", $vote["date"]);
        $dateOfVote->setTime(0, 0, 0);

        return $this->processor->processRawCandidateData(
            $response->getBody(true),
            $mp,
            $dateOfVote
        );
    }
    
}
