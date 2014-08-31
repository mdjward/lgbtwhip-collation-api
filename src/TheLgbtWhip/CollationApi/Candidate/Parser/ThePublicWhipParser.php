<?php
/**
 * ThePublicWhipParser.php
 * Definition of class ThePublicWhipParser
 * 
 * Created 30-Aug-2014 22:13:24
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */
namespace TheLgbtWhip\CollationApi\Candidate\Parser;

use DOMDocument;
use DOMNodeList;
use DOMXPath;



/**
 * ThePublicWhipParser
 * 
 * @author M.D.Ward <dev@mattdw.co.uk>
 */
class ThePublicWhipParser
{
    
    public function parse($html)
    {
        $start = strpos($html, '<table class="votes" id="votetable">');
        $end = strpos($html, '</table>') - $start + 8;

        if ($start === false || $end === false) {
            return null;
        }

        $htmlFragment = str_replace("&", "&amp;", substr($html, $start, $end));

        $dom = new DOMDocument();
        $dom->loadHTML("<html><body>{$htmlFragment}</body></html>");

        $xpath = new DOMXPath($dom);
        
        return $this->processVotingTable($xpath);
    }
    
    protected function processVotingTable(DOMXPath $xpath)
    {
        $votes = [];
        
        foreach ($xpath->query("//tr[not(contains(@class, 'heading'))]") as $rowElement) {
            $nameElements = $xpath->query("./td[1]/a[1]", $rowElement);
            $constituencyElements = $xpath->query("./td[2]/a[1]", $rowElement);
            $voteElements = $xpath->query("./td[4]", $rowElement);

            foreach ([$nameElements, $constituencyElements, $voteElements] as $elements) {
                if ($elements->length < 1) {
                    continue 2;
                }
            }
            
            $name = $this->convertNameString($nameElements);

            $votes[$name] = [
                "name" => $name,
                "constituency" => trim($constituencyElements->item(0)->nodeValue),
                "vote" => $this->convertVoteString($voteElements)
            ];
        }
        
        return $votes;
    }
    
    protected function convertNameString(DOMNodeList $nameElements)
    {
        return preg_replace(
            '#^(?:(?:Mr)|(?:Mrs)|(?:Ms)|(?:Miss)|(?:Sir))\.?\s(.+)$#i',
            '\1',
            trim($nameElements->item(0)->nodeValue)
        );
    }
    
    protected function convertVoteString(DOMNodeList $voteElements)
    {
        switch (trim($voteElements->item(0)->nodeValue)) {
            case 'aye':
                return 1;
            case 'no':
                return -1;
        }
        
        // Absent/abstained
        return 0;
    }
    
}
