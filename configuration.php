<?php
/**
 * configuration.php
 * 
 * Created 30-Aug-2014 19:53:09
 *
 * @author M.D.Ward <dev@mattdw.co.uk>
 * 
 */

require_once __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Yaml\Parser;



$yamlParser = new Parser();

$config = [];

foreach (["config", "apikeys"] as $configFile) {
    $filePath = sprintf("%s/config/%s.yml", __DIR__, $configFile);
    
    if (file_exists($filePath)) {
        $config = array_merge($config, $yamlParser->parse(file_get_contents($filePath)));
    }
}

return $config;
