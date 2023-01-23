<?php

require './vendor/autoload.php';

use Helge\Loader\JsonLoader;
use Helge\Client\SimpleWhoisClient;
use Helge\Service\DomainAvailability;

$whoisClient = new SimpleWhoisClient();
$dataLoader = new JsonLoader("src/data/servers.json");

$service = new DomainAvailability($whoisClient, $dataLoader);


try {
    if (isset($_GET["domain"])) {
        if ($service->isAvailable($_GET["domain"])) {
            echo "<span style='color:green;'>Available</span>" . "<br>";
        } else {
            echo "<span style='color:red;'>Unavailable</span>" . "<br>";
        }
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}

echo $whoisClient->getServer() . "<br>";
echo $whoisClient->getPort() . "<br>";
echo "<pre>". $whoisClient->getResponse() . "</pre>";