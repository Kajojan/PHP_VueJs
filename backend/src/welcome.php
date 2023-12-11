<?php
require_once 'config.php';


if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
    // header('Access-Control-Allow-Origin: *');
    // header('Content-Type: application/json');
    // echo json_encode($client);
    $redirectUri = 'http://localhost:8080/';
    header('Location: ' . $redirectUri  . "?name=" . $name);
}
