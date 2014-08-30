<?php
/**
 * configuration.php
 * 
 * Created 30-Aug-2014 19:53:09
 *
 * @author M.D.Ward <matthew.ward@byng-systems.com>
 * 
 */

require_once __DIR__ . "/vendor/autoload.php";

use Symfony\Component\Yaml\Parser;



$yamlParser = new Parser();

return array_merge(
    $yamlParser->parse(
        file_get_contents(__DIR__ . "/config/config.yml")
    ),
    $yamlParser->parse(
        file_get_contents(__DIR__ . "/config/apikeys.yml")
    )
);
