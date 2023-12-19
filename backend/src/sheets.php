<?php
require_once 'config.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

session_id('2baab19791c8a2783180caf4f5c9f309');
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$client->setAccessToken($_SESSION['token']['access_token']);

$service = new Google_Service_Sheets($client);

$spreadsheetId = $data['id'];
$response = $service->spreadsheets->get($spreadsheetId)->getSheets();


echo json_encode($response);
