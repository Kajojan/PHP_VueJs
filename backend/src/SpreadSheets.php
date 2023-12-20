<?php
session_id('92a67659fd5044722266142ea7e849d3');
session_start();


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

echo json_encode($_SESSION["spreadsheets"]);
