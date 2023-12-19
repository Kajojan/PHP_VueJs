<?php

use Google\Service\Analytics\Column;

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
$sheetName = $data['sheetName'];
$sheetData= $data['data'];



$options = ['valueInputOption' => 'USER_ENTERED'];
$valueInputOption = 'RAW';
// $service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $options);
foreach ($sheetData as $key => $value) {
    $values = [
        [$value['title']],
    ];
    $updateBody = new Google_Service_Sheets_ValueRange(['values' => $values]);
    $service->spreadsheets_values->update($spreadsheetId, $sheetName . '!' . $key , $updateBody, ['valueInputOption' => 'RAW']);
}
$spreadsheets = $service->spreadsheets_values->get($spreadsheetId, $sheetName);

var_dump($spreadsheets);

