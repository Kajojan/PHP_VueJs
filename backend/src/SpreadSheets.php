<?php
session_id('2baab19791c8a2783180caf4f5c9f309');
session_start();


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

echo json_encode($_SESSION["spreadsheets"]);
