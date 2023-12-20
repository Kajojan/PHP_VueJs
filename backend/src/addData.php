<?php

use Google\Service\Analytics\Column;

require_once 'config.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

session_id('92a67659fd5044722266142ea7e849d3');
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$answers = json_decode(file_get_contents('response-payload.json'), true);


$client->setAccessToken($_SESSION['token']['access_token']);

$service = new Google_Service_Sheets($client);

$spreadsheetId = $data['id'];
$sheetName = $data['sheetName'];
$sheetData= $data['data'];



$options = ['valueInputOption' => 'USER_ENTERED'];
$valueInputOption = 'RAW';
// foreach ($sheetData as $key => $value) {
//     $values = [
//         [$value['title']],
//     ];
//     $updateBody = new Google_Service_Sheets_ValueRange(['values' => $values]);
//     $service->spreadsheets_values->update($spreadsheetId, $sheetName . '!' . $key , $updateBody, ['valueInputOption' => 'RAW']);
// }
// var_dump(json_encode($answers));
foreach ($sheetData as $key => $value) {
    foreach ($answers['answers'] as $answerData) {
        var_dump(json_encode($answerData['component']['id']));
        var_dump(json_encode($key));
        $keyInt = intval(mb_substr($key, 1));

        if($value['id'] === $answerData['component']['id']) {
            $values = [
                [$value['title']],
                [$answerData[$answerData['type']]]
            ];

            $updateBody = new Google_Service_Sheets_ValueRange(['values' => $values]);

            $service->spreadsheets_values->update($spreadsheetId, $sheetName . '!' . $key, $updateBody, ['valueInputOption' => 'RAW']);
        }
    }
}
$spreadsheets = $service->spreadsheets_values->get($spreadsheetId, $sheetName);
var_dump($spreadsheets);

