<?php
session_id('8796986e3e86ea3b7f344fcaf1a4511c');
session_start();
require_once 'config.php';


$spreadsheets = [];
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
    $_SESSION['email'] = $email;
    $_SESSION['name'] = $name;


    $service = new Google_Service_Drive($client);

    try {
        $files = $service->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.spreadsheet'",
            'fields' => 'nextPageToken, files(id, name,permissions )'
        ]);
        foreach ($files->getFiles() as $file) {

            if ($file->getpermissions()) {
                foreach ($file->getpermissions() as $perm) {
                    if ($perm->getemailAddress() == $email and ($perm->getrole() == 'writer' or $perm->getrole() == 'owner')) {
                        array_push($spreadsheets, $file);
                    }
                }
            } 
            
        }
        if (!empty($spreadsheets)) {
            $_SESSION['spreadsheets'] = $spreadsheets;
        }
        
        session_write_close();
    } catch (Google_Service_Exception $e) {
        echo 'Błąd: ' . $e->getMessage() . ' ';
    }
    $redirectUri = 'http://localhost:8080/spreadsheets';

    header('Location: ' . $redirectUri  . "?name=" . $name);
    exit;
}
