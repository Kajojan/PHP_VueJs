<?php
session_id('8796986e3e86ea3b7f344fcaf1a4511c');
session_start();


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

echo json_encode($_SESSION["spreadsheets"]);
