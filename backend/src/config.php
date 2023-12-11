<?php
require_once '../vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();


$clientID = "698262782219-7rgkd1t9oudh5tkn9lgemu507p7cgpc9.apps.googleusercontent.com";
$clientSecret = "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";
$redirectUri = 'http://localhost:8000/welcome.php';

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");
