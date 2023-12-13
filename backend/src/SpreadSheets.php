<?php
session_id('01e82f05267f0e9ce6965fd3da140126');
session_start();


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
header('Content-Type: application/json');

echo json_encode($_SESSION["spreadsheets"]);
