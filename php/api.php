<?php
require_once('database.php');
ini_set('display_errors', 1);
error_reporting(E_ALL);

$db = dbConnect();
if(!$db){
    header('HTTP/1.1 503 Service Unavailable');
    echo "Base de données indisponible. Merci de contacter l’administrateur.";
    exit;
}


?>