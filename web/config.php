<?php
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb://mongo-admin:password@192.168.12.7:27017");
    $collection = $client->{'crime'}->{'crimeCollection'};
?>