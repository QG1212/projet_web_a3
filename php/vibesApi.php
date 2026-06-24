<?php
header('Content-Type: application/json; charset=utf-8');

require_once('../php/database.php'); 
require_once('../php/page_visualisation.php');

$db = dbConnect();

if (!$db) {
    http_response_code(503);
    echo json_encode(['erreur' => 'Base de données indisponible.']);
    exit;
}

$action = ''; 

if (isset($_GET['action'])) {
    $action = $_GET['action']; 
    
}try {
    if ($action === 'getPdc') {
        $donneesPdc = getAllPdc($db); 
        echo json_encode($donneesPdc);

    } elseif ($action === 'getStations') {
        $donneesStations = getAllStations($db);
        echo json_encode($donneesStations);

    } else {
        http_response_code(400);
        echo json_encode(['erreur' => 'Action non reconnue.']);
    }

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['erreur' => 'Erreur serveur : ' . $e->getMessage()]);
}
?>