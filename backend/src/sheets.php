<?php
require_once 'config.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

session_id('01e82f05267f0e9ce6965fd3da140126');
session_start();

$data = json_decode(file_get_contents('php://input'), true);


$client->setAccessToken($_SESSION['token']['access_token']);

$service = new Google_Service_Sheets($client);

$spreadsheetId = $data['id'];
$response = $service->spreadsheets->get($spreadsheetId);


echo json_encode($response);
